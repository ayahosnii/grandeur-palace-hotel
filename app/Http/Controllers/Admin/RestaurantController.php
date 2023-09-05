<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Meal;
use App\Models\cr;
use App\Models\Service;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function front()
    {
        $breakFastMeals = Meal::where('category', 'breakfast')->get();
        $count = $breakFastMeals->count() / 2;
        $breakFastChunks = $breakFastMeals->chunk($count);

        $lunchMeals = Meal::where('category', 'lunch')->get();
        $count = $lunchMeals->count() / 2;
        $lunchChunks = $lunchMeals->chunk($count);

        $dinnerMeals = Meal::where('category', 'dinner')->get();
        $count = $dinnerMeals->count() / 2;
        $dinnerChunks = $dinnerMeals->chunk($count);

        return view('restaurant', [
            'breakFastChunks' => $breakFastChunks,
            'lunchChunks' => $lunchChunks,
            'dinnerChunks' => $dinnerChunks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $services = Service::where('display_on_homepage', 1)->get()->random(4);
        return view('about', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
