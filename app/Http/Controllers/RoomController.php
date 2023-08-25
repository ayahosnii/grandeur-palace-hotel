<?php

namespace App\Http\Controllers;

use App\Models\admin\Room;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Review;
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


    public function reservation()
    {
        return view('reservation');
    }

    public function details($id)
    {
        $room = Room::with('services')->find($id);

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

    public function reviewsApi(Request $request)
    {
        $clientsWithReviews = Customer::whereHas('bookings.reviews')->with('bookings.reviews')->get();

        $averageRatingForAll = $clientsWithReviews->flatMap(function ($customer) {
            return $customer->bookings->flatMap->reviews->pluck('rating')->avg();
        });

        return response()->json([
            'customersWithReviews' => $clientsWithReviews,
            'averageRatingForAll' => $averageRatingForAll,
        ]);
    }

    public function roomsDetailsApi(Request $request)
    {
        $id = $request->input('roomId');

        $rooms = Room::where('id', $id)->with('images', 'services')->get();

        return response()->json($rooms);
    }

    public function storeReviews(Request $request)
    {
        /*return response()->json($request->input('rating'));
        $request->validate([
            'bookingCode' => 'required|string|max:5',
            'rating' => 'required|integer|min:1|max:5',
            'reviewText' => 'required|string',
        ]);*/

        $booking = Booking::where('booking_code', $request->input('bookingCode'))->first();

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        if ($booking->room_id !== $request->input('roomId')) {
            return response()->json(['error' => 'You booked another room'], 400);
        }

        $existingReview = Review::where('booking_code', $request->input('bookingCode'))->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed with this booking code'], 400);
        }


        $review = new Review([
            'booking_id' => $booking->id,
            'booking_code' => $request->input('bookingCode'),
            'rating' => $request->input('rating'),
            'review_text' => $request->input('newComment'),
        ]);

        $booking->reviews()->save($review);

        return response()->json(['message' => 'Review submitted successfully']);
    }
    public function bookingsApi(Request $request)
    {
        $id = $request->input('roomId');
        $bookings = Booking::where('room_id', $id)->get();

        return response()->json($bookings);
    }

    public function allBookingsApi(Request $request)
    {
        $bookings = Booking::get();

        return response()->json($bookings);
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
        $availableRooms = $this->checkRoomsAvailability($formCheckIn, $formCheckOut);

        return response()->json(['rooms' => $availableRooms]);
    }

    public function checkRoomsAvailability($formCheckIn, $formCheckOut)
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

    public function checkTheRoomAvailability(Request $request)
    {
        $roomId = $request->input('roomId');
        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));

        $now = Carbon::now();

        if ($checkIn <= $now || $checkOut <= $now) {
            return response()->json(['message' => 'You can\'t check this room. Check-in or check-out is in the past.']);
        }

        $bookingsForRoom = Booking::where('room_id', $roomId)->get();

        // Check if the room is available for the requested dates
        $isRoomAvailable = true;

        foreach ($bookingsForRoom as $booking) {
            $bookingCheckIn = Carbon::parse($booking->check_in);
            $bookingCheckOut = Carbon::parse($booking->check_out);

            if (
                $checkIn >= $bookingCheckIn && $checkIn < $bookingCheckOut ||
                $checkOut > $bookingCheckIn && $checkOut <= $bookingCheckOut
            ) {
                $isRoomAvailable = false;
                break;
            }
        }

        if ($isRoomAvailable) {
            return response()->json(['message' => 'This room is available']);
        } else {
            return response()->json(['message' => 'This room is not available']);
        }
    }


   public function servicesApi(Request $request)
   {
       $services = Service::get();

       return response()->json($services);
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
