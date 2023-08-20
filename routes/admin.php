<?php

use App\Http\Controllers\Admin\DashboardController;
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
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
########################################## Start Languages Route ##############################################################
Route::get('/rooms/index', [RoomController::class, 'index'])->name('admin.rooms');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.rooms.create');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('admin.rooms.edit');
Route::post('/rooms/update', [RoomController::class, 'update'])->name('admin.rooms.update');
Route::get('/rooms/destroy', [RoomController::class, 'destroy'])->name('admin.rooms.delete');
########################################## End  Languages Route ##############################################################
