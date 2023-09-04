<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BookingService;
use App\Helpers\GuestCheckInOut\CheckInOut;
use App\Helpers\GuestCheckInOut\Discounts\EarlyBirdDiscount;
use App\Helpers\GuestCheckInOut\Discounts\NoDiscount;
use App\Helpers\GuestCheckInOut\VIPCheckInOut;
use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmation;
use App\Models\admin\GuestCheckInOut;
use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;
use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class GuestCheckInOutController extends Controller
{

    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }


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
        $rooms = Room::whereHas('roomwithnumber')->get();

        return view('admin.guest-booking.create', compact('rooms'));
    }

    public function roomAvailability($randomRoom)
    {
       dd($randomRoom);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new customer
            $customer = Customer::create([
                'firstname' => $request->input('firstName'),
                'lastname' => $request->input('lastName'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);

            // Parse input dates and generate a booking code
            $checkInDate = Carbon::parse($request->input('check_in'));
            $checkOutDate = Carbon::parse($request->input('check_out'));
            $paymentDate = Carbon::now();
            $roomIds = $request->input('rooms');
            $quantities = $request->input('quantity');
            $bookingCode = mt_rand(10000, 99999);

            // Create a booking record
            $booking = new Booking;
            $booking->booking_code = $bookingCode;
            $booking->customer_id = $customer->id;
            $booking->check_in = $checkInDate;
            $booking->check_out = $checkOutDate;
            $booking->payment_date = $paymentDate;
            $booking->save();

            $bookingService = new BookingService();
            // Calculate the total price for the booking
            $totalPrice = $bookingService->bookRooms($roomIds, $quantities, $booking, $checkInDate, $checkOutDate);

            // Determine which discount to apply based on the check-in date
            $discountPromotion = $this->shouldApplyEarlyBirdDiscount($paymentDate, $checkInDate)
                ? new EarlyBirdDiscount()
                : new NoDiscount();

            $checkInOut = new VIPCheckInOut($checkInDate, $checkOutDate, $totalPrice, $discountPromotion);

            // Calculate total cost before and after discount
            $totalCostBeforeDiscount = $totalPrice;
            $totalCostAfterDiscount =  $checkInOut->applyDiscount($checkInOut->totalCost());

            $booking->total_price = $totalCostAfterDiscount;
            $booking->save();

            // Commit the database transaction
            DB::commit();

            // Return a success response with booking details
            return response()->json([
                'message' => 'Check-in successful',
                'total_cost_before_discount' => $totalCostBeforeDiscount,
                'total_cost_after_discount' => $totalCostAfterDiscount,
                'discountPromotion' => $discountPromotion,
            ]);
        } catch (\Exception $e) {
            // If an exception is thrown, roll back the transaction to cancel any changes
            DB::rollBack();

            // Handle the exception (e.g., log it or return an error response)
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Handle guest check-in if needed
        return $this->checkInGuest($customer, $booking);
    }

    public function shouldApplyEarlyBirdDiscount($checkIn, $paymentDate)
    {
        $checkInTime = Carbon::parse($checkIn);
        $paymentDate = Carbon::parse($paymentDate);
        return $checkInTime->diffInDays($paymentDate) >= 30;
    }

    private function checkInGuest($customer, $booking)
    {
        $firstName = $customer->firstname;
        $roomNumber = 100; // You may replace this with actual room number logic
        $paymentDate = now();
        $checkInDate = $booking->check_in;
        $checkOutDate = $booking->check_out;
        $totalPrice = $booking->total_price;

        // Determine which discount to apply based on the check-in date
        if ($this->shouldApplyEarlyBirdDiscount($paymentDate, $checkInDate)) {
            $discountPromotion = new EarlyBirdDiscount();
        } else {
            $discountPromotion = new NoDiscount();
        }

        $checkInOut = new CheckInOut($firstName, $roomNumber, $paymentDate, $checkInDate, $checkOutDate, $totalPrice, $discountPromotion);

        return response()->json(['message' => 'success']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\GuestCheckInOut  $guestCheckInOut
     * @return \Illuminate\Http\Response
     */
    public function show(GuestCheckInOut $guestCheckInOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\GuestCheckInOut  $guestCheckInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(GuestCheckInOut $guestCheckInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\GuestCheckInOut  $guestCheckInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuestCheckInOut $guestCheckInOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\GuestCheckInOut  $guestCheckInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestCheckInOut $guestCheckInOut)
    {
        //
    }
}
