<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/reservation', [RoomController::class, 'reservation'])->name('reservation');
Route::get('/rooms/{id}', [RoomController::class, 'details'])->name('rooms.details');
Route::get('/api/rooms', [RoomController::class, 'roomsApi'])->name('rooms.api');
Route::get('/api/check-room-availability', [RoomController::class, 'checkAvailability'])->name('rooms.checkAvailability.api');
Route::get('/api/services', [RoomController::class, 'servicesApi'])->name('services.api');
