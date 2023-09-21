<?php

namespace App\Http\Controllers;

use App\Models\admin\Restaurant;
use App\Models\RestaurantBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'selectedDateTime' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $selectedTime = \Carbon\Carbon::parse($value)->format('H:i');
                    if ($selectedTime < '17:00' || $selectedTime > '23:00') {
                        $fail('We are closed during this time. Please select a valid time between 17:00 and 23:00.');
                    }
                },
            ],
            'numberOfPeople' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value > 6) {
                    $fail('Sorry, we can only accommodate groups of 6 people or fewer.');
                }
            }],
            'specialRequest' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create a new booking
        RestaurantBook::create([
            'name' => $request->name,
            'email' => $request->email,
            'from-time' => $request,
            'to-time' => $request,
            'message' => $request,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
