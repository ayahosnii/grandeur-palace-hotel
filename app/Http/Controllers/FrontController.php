<?php

namespace App\Http\Controllers;

use App\Helpers\GuestCheckInOut\CheckInOut;
use App\Helpers\GuestCheckInOut\Discounts\EarlyBirdDiscount;
use App\Helpers\GuestCheckInOut\Discounts\NoDiscount;
use App\Helpers\GuestCheckInOut\ExpressCheckInOut;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::where('display_on_homepage', 1)->get()->random(4);
        return view('welcome', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Standard()
    {
        $guestName = 'Aya';
        $roomNumber = 101;
        $paymentDate = "2023-08-01";
        $checkInDate = "2023-09-01";
        $checkOutDate = "2023-09-05";
        $nightlyRate = 100;

        // Determine which discount to apply based on the check-in date
        if ($this->shouldApplyEarlyBirdDiscount($paymentDate, $checkInDate)) {
            $discountPromotion = new EarlyBirdDiscount();
        } else {
            $discountPromotion = new NoDiscount();
        }

        $checkIn = new CheckInOut($guestName, $roomNumber, $paymentDate, $checkInDate, $checkOutDate, $nightlyRate, $discountPromotion);
        return response()->json(['message' => $checkIn->checkIn()]);
    }

    public function shouldApplyEarlyBirdDiscount($checkInDate, $paymentDate)
    {
        $checkInDateTime = Carbon::parse($checkInDate);
        $paymentDate = Carbon::parse($paymentDate);

        // Determine the criteria for applying the early bird discount
        // In this example, we check if the check-in date is at least 30 days in advance
        return $checkInDateTime->diffInDays($paymentDate) >= 30;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
