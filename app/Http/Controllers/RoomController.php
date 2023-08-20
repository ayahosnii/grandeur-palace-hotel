<?php

namespace App\Http\Controllers;

use App\Models\admin\Room;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        return view('rooms');
    }

    public function create()
    {
        return view('admin.rooms.create');
    }
    public function reservation()
    {
        return view('reservation');
    }

    public function details($id)
    {
        $room = Room::findOrFail($id);

        return view('details', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomsApi(Request $request)
    {
        $rooms = Room::with('services')->get();

        return response()->json($rooms);
    }
    public function checkAvailability(Request $request)
    {
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');

        $carCheckin = Carbon::parse($check_in);
        $carCheckout = Carbon::parse($check_out);

        $formCheckIn = $carCheckin->format('Y-m-d H:i:s');
        $formCheckOut = $carCheckout->format('Y-m-d H:i:s');


//
        $availableRooms = $this->checkRoomAvailability($formCheckIn, $formCheckOut);

        return response()->json(['rooms' => $availableRooms]);
    }

    public function checkRoomAvailability($formCheckIn, $formCheckOut)
    {
        $occupiedRoomIds = Booking::where(function ($query) use ($formCheckIn, $formCheckOut) {
            $query->where(function ($q) use ($formCheckIn, $formCheckOut) {
                $q->where('check_in', '<', $formCheckOut)
                    ->where('check_out', '>', $formCheckIn);
            });
        })->pluck('room_id');

        // Get all room IDs
        $allRoomIds = Room::pluck('id');

        // Calculate available room IDs
        $availableRoomIds = $allRoomIds->diff($occupiedRoomIds);

        // Get the available rooms
        $availableRooms = Room::whereIn('id', $availableRoomIds)->get();

        return $availableRooms;
    }


   public function servicesApi(Request $request)
   {
       $services = Service::get();

       return response()->json($services);
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

            $validatedData = $request->validate([
                'room_type' => 'required|string',
                'price_per_night' => 'required|numeric',
                'size' => 'required|numeric',
                'capacity' => 'required|integer',
                'bed_type' => 'required|string',
                'adults' => 'required|integer',
            ]);

            $room = new Room();
            $room->room_type = $validatedData['room_type'];
            $room->price_per_night = $validatedData['price_per_night'];
            $room->size = $validatedData['size'];
            $room->capacity = $validatedData['capacity'];
            $room->bed_type = $validatedData['bed_type'];
            $room->adults = $validatedData['adults'];

            $room->save();

            DB::commit();

            return redirect()->route('admin.rooms.create')->with('success', 'Room added successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Error while adding room: ' . $e->getMessage());

            if ($e instanceof ValidationException) {
                return redirect()->route('admin.rooms.create')->withErrors($e->validator->errors())->withInput();
            }

            return redirect()->route('admin.rooms.create')->with('error', 'An error occurred while adding the room.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Validate the incoming request data
            $validatedData = $request->validate([
                'room_type' => 'required|string',
                'price_per_night' => 'required|numeric',
                'size' => 'required|numeric',
                'capacity' => 'required|integer',
                'bed_type' => 'required|string',
                'adults' => 'required|integer',
            ]);

            // Find the room record by ID
            $room = Room::findOrFail($id);

            // Update the room attributes with the validated data
            $room->update([
                'room_type' => $validatedData['room_type'],
                'price_per_night' => $validatedData['price_per_night'],
                'size' => $validatedData['size'],
                'capacity' => $validatedData['capacity'],
                'bed_type' => $validatedData['bed_type'],
                'adults' => $validatedData['adults'],
            ]);

            // Commit the database transaction
            DB::commit();

            // Redirect back to the form with a success message
            return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollback();

            // Optionally, log the exception for debugging
            Log::error('Error while updating room: ' . $e->getMessage());

            // You can customize the error message or response as needed
            if ($e instanceof ValidationException) {
                return redirect()->route('admin.rooms.edit', $id)->withErrors($e->validator->errors())->withInput();
            }

            return redirect()->route('admin.rooms.edit', $id)->with('error', 'An error occurred while updating the room.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
