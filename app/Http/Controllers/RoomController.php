<?php

namespace App\Http\Controllers;

use App\Models\admin\Room;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        //
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
        //
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
