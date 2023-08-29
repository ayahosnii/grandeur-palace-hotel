<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PunctualityController;
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
################################## Jobs routes ######################################
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', [JobController::class,'index'])->name('admin.jobs');
    Route::get('create', [JobController::class,'create'])->name('admin.jobs.create');
    Route::post('store', [JobController::class,'store'])->name('admin.jobs.store');
    Route::get('delete/{id}', [JobController::class,'destroy'])->name('admin.jobs.delete');
    Route::get('edit/{id}', [JobController::class,'edit'])->name('admin.jobs.edit');
    Route::post('update/{id}', [JobController::class,'update'])->name('admin.jobs.update');
});
################################## end Jobs    #######################################


################################## Employees routes ######################################
Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeeController::class,'index'])->name('admin.employees');
    Route::get('/profile/{id}', [EmployeeController::class,'profile'])->name('admin.employees.profile');
    Route::get('create', [EmployeeController::class,'create'])->name('admin.employees.create');
    Route::post('store', [EmployeeController::class,'store'])->name('admin.employees.store');
    Route::get('delete/{id}', [EmployeeController::class,'destroy'])->name('admin.employees.delete');
    Route::get('edit/{id}', [EmployeeController::class,'edit'])->name('admin.employees.edit');
    Route::post('update/{id}', [EmployeeController::class,'update'])->name('admin.employees.update');
});
################################## end Employees    #######################################

################################## Attendance routes ######################################
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/', [AttendanceController::class,'index'])->name('admin.attendance');
    Route::get('/the-absence', [AttendanceController::class,'absence'])->name('admin.attendance.absence');
    Route::post('/the-absence/store', [AttendanceController::class,'absenceStore'])->name('admin.absence.store');
    Route::get('create', [AttendanceController::class,'create'])->name('admin.attendance.create');
    Route::post('store', [AttendanceController::class,'store'])->name('admin.attendance.store');
    Route::get('delete/{id}', [AttendanceController::class,'destroy'])->name('admin.attendance.delete');
    Route::get('edit/{id}', [AttendanceController::class,'edit'])->name('admin.attendance.edit');
    Route::post('update/{id}', [AttendanceController::class,'update'])->name('admin.attendance.update');
});
################################## end Attendance    #######################################

################################## punctuality routes ######################################
Route::group(['prefix' => 'punctuality'], function () {
    Route::get('/', [PunctualityController::class,'index'])->name('admin.punctuality');
    Route::post('/store', [PunctualityController::class,'store'])->name('admin.punctuality.store');
});
################################## end punctuality #######################################
