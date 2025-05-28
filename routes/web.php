<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DashboardAttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShowNotificationController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['admin', 'prevent.history.back']], function(){

    Route::get('/dashboard/data', [DashboardController::class, 'result'])->name('dashboard.result');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/total-employee', [DashboardController::class, 'totalEmployees'])->name('dashboard.total.employee');
    Route::get('/dashboard/total-attendance', [DashboardController::class, 'totalAttendances'])->name('dashboard.total.attendance');
    Route::get('/dashboard/total-qr-codes', [DashboardController::class, 'totalQrCodes'])->name('dashboard.total.qrcodes');

    Route::get('/dashboard/employees', function(){
        return view('dashboard.dashboard-employees');
    })->name('dashboard.employees');

    Route::get('/dashboard/employees/all', [EmployeeController::class, 'index'])->name('dashboard.employees.all');
    Route::post('/dashboard/employees/new', [EmployeeController::class, 'save'])->name('dashboard.employees.new');
    Route::get('/dashboard/employees/{uid}', [EmployeeController::class, 'view'])->name('dashboard.employees.view');
    Route::put('/dashboard/employees/update/{id}', [EmployeeController::class, 'update'])->name('dashboard.employees.update');
    Route::get('/dashboard/employees/get-employee/{id}', [EmployeeController::class, 'getEmployee'])->name('dashboard.employees.get.employee');
    Route::post('/dashboard/employees/search', [EmployeeController::class, 'search'])->name('dashboard.employees.search');
    Route::get('/dashboard/employees/get-employee-attendance-history/{id}', [EmployeeController::class, 'singleUserAttendance']);

    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('dashboard.settings');
    Route::post('/dashboard/settings/update-password', [SettingsController::class, 'updatePassword']);
    Route::post('/dashboard/settings/update-username-email', [SettingsController::class, 'updateEmailUser']);
    Route::post('/dashboard/settings/update-company-profile', [SettingsController::class, 'storeProfile']);


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

    Route::post('/logout', [LoginController::class, 'logout']);

    /**
     * Notifications
     * **/
    Route::get('/dashboard/attendance/notifications', [ShowNotificationController::class, 'index'])->name('dashboard.notifications');
    Route::delete('/dashboard/attendance/notifications/delete/{id}', [ShowNotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::get('/dashboard/attendance/notifications/unread', [ShowNotificationController::class, 'showUnreadNotification']);
    Route::get('/dashboard/attendance/notifications/mark-as-read', [ShowNotificationController::class, 'markAsRead']);


});

Route::middleware('guest')->group(function () {
    
// Auth::routes(); 
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/password/reset', [LoginController::class, 'showResetForm'])->name('password.request');
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
