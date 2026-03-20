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
Route::get('/time-attendances/morning-check-in', [TimeAttendanceController::class, 'morningCheckIn'])->name('time_attendances.morning_check_in');
Route::post('/time-attendances/morning-check-in', [TimeAttendanceController::class, 'storeMorningCheckIn'])->name('time_attendances.storeMorningCheckIn');
Route::get('/time-attendances/afternoon-check-in', [TimeAttendanceController::class, 'afternoonCheckIn'])->name('time_attendances.afternoon_check_in');
Route::post('/time-attendances/afternoon-check-in', [TimeAttendanceController::class, 'storeAfternoonCheckIn'])->name('time_attendances.storeAfternoonCheckIn');
Route::get('/time-attendances/export', [TimeAttendanceController::class, 'exportToExcel'])->name('time_attendances.export');
