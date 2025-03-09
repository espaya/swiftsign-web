<?php

use App\Http\Controllers\mobile\LogAttendance;
use App\Http\Controllers\mobile\mobileAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/employee/sign-in', [mobileAuthController::class, 'signIn'])->name('mobile.signIn');
Route::post('/employee/log-attendance', [LogAttendance::class, 'newAttendance'])->name('mobile.log.attendance');
