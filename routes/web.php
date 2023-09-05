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
Route::get('/about-us', [RestaurantController::class, 'about'])->name('about');
Route::get('/contact-us', [RestaurantController::class, 'contact'])->name('contact');
################################## Rooms Cleaning Queue routes ######################################
Route::group(['prefix' => 'room-cleaning-queue'], function () {
    Route::get('/', [RoomCleaningQueueController::class, 'index'])->name('room-cleaning-queue.index');
    Route::get('/dd', [RoomCleaningQueueController::class, 'dd'])->name('room-cleaning-queue.dd');
    Route::post('/enqueue', [RoomCleaningQueueController::class, 'enqueue'])->name('room-cleaning-queue.enqueue');
    Route::post('/clean', [RoomCleaningQueueController::class, 'clean'])->name('room-cleaning-queue.clean');});
################################## end Rooms Cleaning Queue    #######################################
