<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/bookings', [RoomController::class, 'bookingsApi'])->name('bookings.api');
Route::get('/all-bookings', [RoomController::class, 'allBookingsApi'])->name('all.bookings.api');

Route::get('/rooms', [RoomController::class, 'roomsApi'])->name('rooms.details.api');
Route::get('/rooms-details', [RoomController::class, 'roomsDetailsApi'])->name('rooms.api');

Route::get('/reviews', [RoomController::class, 'reviewsApi'])->name('reviews.api');
Route::post('/storeReviews', [RoomController::class, 'storeReviews'])->name('rooms.store.reviews');


Route::post('/contact', [ContactUsController::class, 'store'])->name('rooms.store.contact');
Route::post('/bookTable', [RestaurantController::class, 'store'])->name('rooms.store.contact');

Route::get('/check-rooms-availability', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability.api');
Route::get('/check-the-room-availability', [RoomController::class, 'checkTheRoomAvailability'])->name('rooms.checkTheRoomAvailability.api');

Route::get('/services', [RoomController::class, 'servicesApi'])->name('services.api');

Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store.api');

Route::get('/guest-booking', [FrontController::class, 'Standard'])->name('bookings.guest');
