<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimeAttendanceController;

// Main page
Route::get('/', function () {
    return view('home');
});

// Employee routes
Route::resource('employees', EmployeeController::class);

// Time attendance routes
Route::get('/time-attendances', [TimeAttendanceController::class, 'index'])->name('time_attendances.index');
Route::get('/time-attendances/clock-in', [TimeAttendanceController::class, 'clockIn'])->name('time_attendances.clock_in');
Route::post('/time-attendances/clock-in', [TimeAttendanceController::class, 'storeClockIn'])->name('time_attendances.storeClockIn');
Route::get('/time-attendances/clock-out', [TimeAttendanceController::class, 'clockOut'])->name('time_attendances.clock_out');
Route::post('/time-attendances/clock-out', [TimeAttendanceController::class, 'updateClockOut'])->name('time_attendances.updateClockOut');
Route::get('/time-attendances/export', [TimeAttendanceController::class, 'exportToExcel'])->name('time_attendances.export');

// Direct check-in/out routes for home page
Route::post('/direct-clock-in', [TimeAttendanceController::class, 'directClockIn'])->name('direct.clock_in');
Route::post('/direct-clock-out', [TimeAttendanceController::class, 'directClockOut'])->name('direct.clock_out');
