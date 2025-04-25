<?php

use App\Http\Controllers\mobile\LogAttendance;
use App\Http\Controllers\mobile\MobileAccountController;
use App\Http\Controllers\mobile\mobileAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/employee/sign-in', [mobileAuthController::class, 'signIn'])->name('mobile.signIn');

Route::post('/employee/log-attendance', [LogAttendance::class, 'newAttendance'])->name('mobile.log.attendance');

Route::post('/employee/update-profile-picture', [MobileAccountController::class, 'updateProfilePic'])->name('mobile.update.profile.pic');

Route::get('/employee/get-profile-pic/{id}', [MobileAccountController::class, 'getProfilePicture'])->name('mobile.get.profile.picture');

Route::post('/employee/update-email-username/{id}', [MobileAccountController::class, 'updateUsernameEmail'])
    ->name('mobile.update.username.email');

Route::get('/employee/log-attendance/all/{id}', [LogAttendance::class, 'getAttendance']);
