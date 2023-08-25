<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'customer.firstname' => 'required|string',
            'customer.lastname' => 'required|string',
            'customer.phone' => 'required|integer',
            'customer.email' => 'required|email|unique:customers,email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $bookingCode = mt_rand(10000, 99999);
        $roomId = $request->input('roomId');
        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));

        // Check if check-in or check-out is in the past
        $now = Carbon::now();

        if ($checkIn <= $now || $checkOut <= $now) {
            return response()->json(['message' => 'You can\'t book this room. Check-in or check-out is in the past.']);
        }

        // Get all bookings for the specified room
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
            // Check if the customer already exists by email
            $customer = Customer::where('email', $request->input('customer.email'))->first();

            // If the customer doesn't exist, create a new one
            if (!$customer) {
                $customer = new Customer([
                    'firstname' => $request->input('customer.firstname'),
                    'lastname' => $request->input('customer.lastname'),
                    'phone' => $request->input('customer.phone'),
                    'email' => $request->input('customer.email'),
                ]);
                $customer->save();
            }

            // Create a new booking associated with the customer
            $booking = new Booking([
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'booking_code' => $bookingCode,
                'customer_id' => $customer->id,
                'room_id' => $roomId
            ]);
            $booking->save();

            DB::commit();

            return response()->json(['message' => 'Booking created successfully']);
        } else {
            DB::rollBack();
            // The room is not available for the requested dates
            return response()->json(['message' => 'This room is not available for the selected dates']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
