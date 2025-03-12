<?php

use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\DashboardAttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\mobile\mobileAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['guest']], function(){

    Route::get('/dashboard', function(){
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/dashboard/employees', function(){
        return view('dashboard.dashboard-employees');
    })->name('dashboard.employees');

    Route::get('/dashboard/team', function(){
        return view('dashboard.team');
    })->name('team');

    Route::get('/dashboard/employees/all', [EmployeeController::class, 'index'])->name('dashboard.employees.all');
    Route::post('/dashboard/employees/new', [EmployeeController::class, 'save'])->name('dashboard.employees.new');
    Route::get('/dashboard/employees/{uid}', [EmployeeController::class, 'view'])->name('dashboard.employees.view');
    Route::put('/dashboard/employees/update/{id}', [EmployeeController::class, 'update'])->name('dashboard.employees.update');
    Route::get('/dashboard/employees/get-employee/{id}', [EmployeeController::class, 'getEmployee'])->name('dashboard.employees.get.employee');
    Route::post('/dashboard/employees/search', [EmployeeController::class, 'search'])->name('dashboard.employees.search');

    Route::get('/dashboard/settings', function(){
        return view('dashboard.dashboard-settings');
    })->name('dashboard.settings');

    Route::get('/dashboard/qr-code', [QRCodeController::class, 'index'])->name('dashboard.qr.code');
    Route::post('/dashboard/qr-code/generate', [QRCodeController::class, 'createQrCode'])->name('dashboard.qr.code.generate');
    Route::get('/dashboard/qr-code/all', [QRCodeController::class, 'getAllQrCode'])->name('dashboard.qr.code.all');
    Route::get('/dashboard/qr-code/search', [QRCodeController::class, 'searchQrCode'])->name('search.qr');
    Route::delete('/dashboard/qr-code/all/delete', [QRCodeController::class, 'destroy'])->name('delete.qr');

    Route::get('/dashboard/attendance', [DashboardAttendanceController::class, 'index'])->name('dashboard.attendance');
    Route::get('/dashboard/attendance/all', [DashboardAttendanceController::class, 'getAllAttendance'])->name('dashboard.attendance.all');
    Route::delete('dashboard/attendance/all/delete/{id}', [DashboardAttendanceController::class, 'destroy'])
        ->name('dashboard.attendance.delete');
    
    Route::get('/dashboard/employee/get-email-username/{id}', [ProfileController::class, 'getUsernameEmail'])
        ->name('dashboard.get.username.email');

    Route::put('/dashboard/employee/update-email-username/{id}', [ProfileController::class, 'updateUsernameEmail'])
        ->name('dashboard.update.username.email');

    Route::post('/dashboard/employee/update-password/{id}', [ProfileController::class, 'updatePassword']);
    Route::post('/dashboard/employee/update-profile-picture/{id}', [ProfileController::class, 'updateProfilePicture']);
    Route::get('/dashboard/employee/get-profile-picture/{id}', [ProfileController::class, 'getProfilePicture']);

    Route::get('/dashboard/employee/check-employee-status/{id}', [ProfileController::class, 'isBlocked'])->name('is.blocked');
    
    Route::post('/dashboard/employee/block-employee/{id}', [ProfileController::class, 'blockEmployee'])->name('block.employee');
});

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
