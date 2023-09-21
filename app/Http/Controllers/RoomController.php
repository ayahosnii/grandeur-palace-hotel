<?php

namespace App\Http\Controllers;

use App\Helpers\RoomAvailabilityChecker;
use App\Models\admin\BookingRoomPivot;
use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;
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
    public function search(Request $request)
    {
        // Retrieve query parameters from the request
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $guests = $request->input('guests');


        $carCheckin = Carbon::parse($check_in);
        $carCheckout = Carbon::parse($check_out);

        $formCheckIn = $carCheckin->format('Y-m-d H:i:s');
        $formCheckOut = $carCheckout->format('Y-m-d H:i:s');


//
        $availableRooms = $this->checkRoomsAvailability($formCheckIn, $formCheckOut);

        return view('search', compact('availableRooms'));
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
        $roomId = $request->input('roomId');

        $filteredCustomers = Customer::whereHas('bookings.reviews', function ($query) use ($roomId) {
            $query->where('room_id', $roomId);
        })
            ->with('bookings.reviews')
            ->get();

        $totalRating = 0;
        $totalReviews = 0;

        foreach ($filteredCustomers as $customer) {
            foreach ($customer->bookings as $booking) {
                foreach ($booking->reviews as $review) {
                    // Sum up the ratings and count the reviews
                    $totalRating += $review->rating;
                    $totalReviews++;
                }
            }
        }

        if ($totalReviews > 0) {
            $averageRating = $totalRating / $totalReviews;
        } else {
            $averageRating = 0;
        }

        return response()->json([
            'customersWithReviews' => $filteredCustomers,
            'averageRatingForAll' => $averageRating,
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
        $request->validate([
            'bookingCode' => 'required|string|max:5',
            'rating_type' => 'required|integer|min:1|max:2',
        ]);

        $reviewType = $request->input('rating_type');

        if ($reviewType == 1 || 2) {
            $booking = Booking::where('booking_code', $request->input('bookingCode'))->first();

            if (!$booking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }

            if ($reviewType == 2) {
                $matchingRoom = $booking->rooms->first(function ($room) use ($request) {
                    return $room->room_id == $request->input('roomId');
                });

                if (!$matchingRoom) {
                    return response()->json(['error' => 'You booked another room'], 400);
                }

                $existingReview = Review::where('booking_code', $request->input('bookingCode'))->first();

                if ($existingReview) {
                    return response()->json(['error' => 'You have already reviewed with this booking code'], 400);
                }
            }
        }



        $review = new Review([
            'booking_id' => $booking->id,
            'booking_code' => $request->input('bookingCode'),
            'rating' => $request->input('rating'),
            'review_text' => $request->input('message'),
            'review_type' => $reviewType,
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
        $checkInDate = Carbon::parse($formCheckIn);
        $checkOutDate = Carbon::parse($formCheckOut);

        // Get All Rooms with their room types
        $roomsWithNumbers = RoomsWithNumber::pluck('room_id');

        $bookedRoomIds = BookingRoomPivot::whereHas('booking', function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
        })->pluck('room_id');

        // Filter rooms based on availability and not being booked
        $availableRoomIds = $roomsWithNumbers->diff($bookedRoomIds)->toArray();

        $availableRooms = Room::whereIn('id', $availableRoomIds)->get();

        // Count each room separately
        $availableRoomCounts = array_count_values($availableRoomIds);

        // Format rooms data
        $formattedRooms = $availableRooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_type' => $room->room_type,
                'image' => $room->image,
                'price_per_night' => $room->price_per_night,
                'size' => $room->size,
                'capacity' => $room->capacity,
                'bed_type' => $room->bed_type,
                'adults' => $room->adults,
                'created_at' => $room->created_at,
                'updated_at' => $room->updated_at,
            ];
        });

        return $formattedRooms;
    }

    public function checkTheRoomAvailability(Request $request)
    {
        $roomId = $request->input('roomId');
        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));

        $now = Carbon::now();

        if ($checkIn < $now || $checkOut < $now) {
            return response()->json(['message' => 'You can\'t check this room. Check-in or check-out is in the past.']);
        }

        try {
            $roomIds = [$roomId];
            $quantities = [1];
            $isRoomAvailable = RoomAvailabilityChecker::isRoomAvailable($roomIds, $quantities, $checkIn, $checkOut);

            if ($isRoomAvailable) {
                return response()->json(['message' => $isRoomAvailable]);
            } else {
                return response()->json(['message' => $isRoomAvailable]);
            }
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()]);
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
