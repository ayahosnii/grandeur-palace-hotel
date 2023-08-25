<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
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
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
########################################## Start Rooms Route ##############################################################
Route::get('/rooms/', [RoomController::class, 'index'])->name('admin.rooms');
Route::get('/rooms/upload-images/{id}', [RoomController::class, 'upload'])->name('rooms.img.upload');
Route::post('/rooms/upload-images-post/{id}', [RoomController::class, 'uploadRoomImage'])->name('rooms.img.upload.post');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
Route::get('/rooms/show/{id}', [RoomController::class, 'show'])->name('admin.rooms.show');
Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('admin.rooms.edit');
Route::put('/rooms/update/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
Route::get('/rooms/destroy', [RoomController::class, 'destroy'])->name('admin.rooms.delete');
########################################## End  Rooms Route ##############################################################
########################################## Start Services Route ##############################################################
Route::get('/services/', [ServiceController::class, 'index'])->name('admin.services');
Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
Route::post('/services/store', [ServiceController::class, 'store'])->name('admin.services.store');
Route::get('/services/show/{id}', [ServiceController::class, 'show'])->name('admin.services.show');
Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
Route::put('/services/update/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
Route::get('/services/destroy', [ServiceController::class, 'destroy'])->name('admin.services.delete');
########################################## End  Services Route ##############################################################
