<?php

namespace App\Http\Controllers;

use App\Helpers\BookingService;
use App\Helpers\GuestCheckInOut\Discounts\EarlyBirdDiscount;
use App\Helpers\GuestCheckInOut\Discounts\NoDiscount;
use App\Helpers\GuestCheckInOut\VIPCheckInOut;
use App\Http\Requests\BookingRequest;
use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'customer.firstname' => 'required|string',
                'customer.lastname' => 'required|string',
                'customer.phone' => 'required',
                'customer.email' => 'required|email',
            ]);

            $paymentDate = Carbon::now();
            $checkInDate = Carbon::parse($request->input('check_in'));
            $checkOutDate = Carbon::parse($request->input('check_out'));

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // Create a new customer
            $customer = Customer::create([
                'firstname' => $request->input('customer.firstname'),
                'lastname' => $request->input('customer.lastname'),
                'phone' => $request->input('customer.phone'),
                'email' => $request->input('customer.email'),
            ]);

            // Get the roomId(s) from the request
            $roomIds = (array)$request->input('roomId'); // Ensure it's an array


            $quantities = [1];
            $bookingCode = mt_rand(10000, 99999);

            // Create a booking record
            $booking = new Booking;
            $booking->booking_code = $bookingCode;
            $booking->customer_id = $customer->id;
            $booking->check_in = $checkInDate;
            $booking->check_out = $checkOutDate;
            $booking->payment_date = $paymentDate;
            $booking->save();

            // Create an instance of BookingService
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
            $totalCostAfterDiscount = $checkInOut->applyDiscount($checkInOut->totalCost());

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

        Mail::to($customer->email)->send(new BookingConfirmation($bookingCode));

        DB::commit();

        return response()->json(['message' => 'Booking(s) created successfully']);
    }



    public function shouldApplyEarlyBirdDiscount($checkIn, $paymentDate)
    {
        $checkInTime = Carbon::parse($checkIn);
        $paymentDate = Carbon::parse($paymentDate);
        return $checkInTime->diffInDays($paymentDate) >= 30;
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
