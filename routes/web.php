<?php

use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RoomCleaningQueueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/rooms-search', [RoomController::class, 'search'])->name('search');
Route::get('/reservation', [RoomController::class, 'reservation'])->name('reservation');
Route::get('/rooms/{id}', [RoomController::class, 'details'])->name('rooms.details');

Route::get('/restaurant', [RestaurantController::class, 'front'])->name('restaurant');


Route::get('/api/bookings', [RoomController::class, 'bookingsApi'])->name('bookings.api');
Route::get('/api/all-bookings', [RoomController::class, 'allBookingsApi'])->name('all.bookings.api');

Route::get('/api/rooms', [RoomController::class, 'roomsApi'])->name('rooms.details.api');
Route::get('/api/rooms-details', [RoomController::class, 'roomsDetailsApi'])->name('rooms.api');

Route::get('/api/reviews', [RoomController::class, 'reviewsApi'])->name('reviews.api');
Route::post('/api/storeReviews', [RoomController::class, 'storeReviews'])->name('rooms.store.reviews');

Route::get('/api/check-rooms-availability', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability.api');
Route::get('/api/check-the-room-availability', [RoomController::class, 'checkTheRoomAvailability'])->name('rooms.checkTheRoomAvailability.api');

Route::get('/api/services', [RoomController::class, 'servicesApi'])->name('services.api');

Route::post('/api/bookings/store', [BookingController::class, 'store'])->name('bookings.store.api');

################################## Rooms Cleaning Queue routes ######################################
Route::group(['prefix' => 'room-cleaning-queue'], function () {
    Route::get('/', [RoomCleaningQueueController::class, 'index'])->name('room-cleaning-queue.index');
    Route::get('/dd', [RoomCleaningQueueController::class, 'dd'])->name('room-cleaning-queue.dd');
    Route::post('/enqueue', [RoomCleaningQueueController::class, 'enqueue'])->name('room-cleaning-queue.enqueue');
    Route::post('/clean', [RoomCleaningQueueController::class, 'clean'])->name('room-cleaning-queue.clean');});
################################## end Rooms Cleaning Queue    #######################################
