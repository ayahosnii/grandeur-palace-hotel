<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Image;
use App\Models\admin\Room;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with('services')->paginate(4);
        return view('admin.rooms.index',compact('rooms'));
    }

    public function upload($id)
    {
        $room = Room::find($id);
        return view('admin.rooms.upload', compact('room'));
    }

    public function uploadRoomImage(Request $request, $id)
    {
        $request->validate([
            'file.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust validation rules as needed
        ]);

        foreach ($request->file('file') as $image) {
            $fileInfo = $image->getClientOriginalName();
            $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $file_name = $filename . '-' . time() . '.' . $extension;
            $image->move(public_path('assets/admin/images/room_images'), $file_name);

            $roomImage = new Image(); // Assuming you have an Image model
            $roomImage->image_path = $file_name; // Adjust to match your column name
            $roomImage->imageable_id = $id; // Adjust to match your column name
            $roomImage->imageable_type = 'App\\Models\\admin\\Room'; // Adjust to match your model's namespace
            $roomImage->save();
        }

        return response()->json(['success' => 'Images uploaded successfully']);
    }

    public function getRoomImages($id)
    {
        // Get the room based on the provided $id
        $room = Room::findOrFail($id);

        // Get the room's images
        $images = $room->images()->get(['filename', 'original_filename']);

        $data = [];

        foreach ($images as $image) {
            $obj = [];
            $obj['name'] = $image->filename;

            $file_path = public_path('uploads/gallery/') . $image->filename;
            $obj['size'] = filesize($file_path);

            $obj['path'] = url('public/uploads/gallery/' . $image->filename);
            $data[] = $obj;
        }

        return response()->json($data);
    }

    public function deleteRoomImage(Request $request, $id)
    {
        $filename = $request->get('filename');

        // Get the room based on the provided $id
        $room = Room::findOrFail($id);

        // Find the image associated with the room by filename
        $image = $room->images()->where('filename', $filename)->first();

        if ($image) {
            // Delete the image record from the database
            $image->delete();

            // Delete the physical file from the storage
            $path = public_path('uploads/gallery/') . $filename;
            if (file_exists($path)) {
                unlink($path);
            }

            return response()->json(['success' => $filename]);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        return view('admin.rooms.create', compact('services'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'room_type' => 'required|string',
                'price_per_night' => 'required|numeric',
                'size' => 'required',
                'capacity' => 'required|integer',
                'bed_type' => 'required|string',
                'adults' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'services' => 'array',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.rooms.create')->withErrors($validator)->withInput();
            }

            $image = $request->file('image');
            $folderName = 'room_images';
            $filename = uploadImage($folderName, $image);

            if (!$filename) {
                DB::rollback();
                return redirect()->route('admin.rooms.create')->with('error', 'Failed to upload the image.');
            }

            $room = new Room([
                'room_type' => $request->input('room_type'),
                'price_per_night' => $request->input('price_per_night'),
                'size' => $request->input('size'),
                'capacity' => $request->input('capacity'),
                'bed_type' => $request->input('bed_type'),
                'adults' => $request->input('adults'),
                'image' => $filename,
            ]);

            $room->save();

            // Attach selected services to the room if any were selected
            if ($request->has('services')) {
                $selectedServices = $request->input('services');
                $room->services()->attach($selectedServices);
            }

            DB::commit();

            return redirect()->route('admin.rooms')->with('success', 'Room added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while adding room: ' . $e->getMessage());

            if ($e instanceof ValidationException) {
                return redirect()->route('admin.rooms')->withErrors($e->validator->errors())->withInput();
            }

            return redirect()->route('admin.rooms')->with('error', 'An error occurred while adding the room.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::with('services', 'images')->find($id);
        return view('admin.rooms.details',compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $room = Room::findOrFail($id);

            $services = Service::pluck('name', 'id');

            $selectedServiceIds = $room->services->pluck('id')->toArray();

            return view('admin.rooms.edit', compact('room', 'services', 'selectedServiceIds'));
        } catch (\Exception $e) {
            return redirect()->route('admin.rooms.index')->with('error', 'An error occurred while editing the room.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Validating the request data
            $validator = Validator::make($request->all(), [
                'room_type' => 'required|string',
                'price_per_night' => 'required|numeric',
                'size' => 'required',
                'capacity' => 'required|integer',
                'bed_type' => 'required|string',
                'adults' => 'required|integer',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Updated image validation rules
                'services' => 'array',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.rooms.edit', $id)->withErrors($validator)->withInput();
            }

            $room = Room::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $folderName = 'room_images';
                $filename = uploadImage($folderName, $image);

                if (!$filename) {
                    DB::rollback();
                    return redirect()->route('admin.rooms.edit', $id)->with('error', 'Failed to upload the image.');
                }

                // Delete the old image file
                if ($room->image) {
                    deleteImage($folderName, $room->image);
                }

                $room->image = $filename;
            }

            $room->room_type = $request->input('room_type');
            $room->price_per_night = $request->input('price_per_night');
            $room->size = $request->input('size');
            $room->capacity = $request->input('capacity');
            $room->bed_type = $request->input('bed_type');
            $room->adults = $request->input('adults');

            $room->save();

            // Sync selected services for the room
            if ($request->has('services')) {
                $selectedServices = $request->input('services');
                $room->services()->sync($selectedServices);
            } else {
                // If no services are selected, detach all existing services
                $room->services()->detach();
            }

            DB::commit();

            return redirect()->route('admin.rooms')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating room: ' . $e->getMessage());

            if ($e instanceof ValidationException) {
                return redirect()->route('admin.rooms.edit', $id)->withErrors($e->validator->errors())->withInput();
            }

            return redirect()->route('admin.rooms.edit', $id)->with('error', 'An error occurred while updating the room.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
