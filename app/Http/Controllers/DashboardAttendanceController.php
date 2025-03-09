<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\mobile\LogAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DashboardAttendanceController extends Controller
{
    // attendance method for admin
    public function index()
    {
        return view('dashboard.dashboard-attendance');
    }

    public function getAllAttendance()
    {
        $attendance = LogAttendance::all()->map(function ($log) {
            $employee = Employee::where('userID', $log->userID)->first(); // Fetch employee 

            return [
                'id' => $log->id,
                'session_id' => Crypt::decryptString($log->session_id),
                'userID' => $log->userID,
                'fullname' => $employee ? Crypt::decryptString($employee->fullname) : 'Unknown',
                'logged_at' => Crypt::decryptString($log->logged_at),
                'signed_out_at' => $log->signed_out_at ? Crypt::decryptString($log->signed_out_at) : null,
                'expired' => $log->expired ? Crypt::decryptString($log->expired) : null,
                'status' => Crypt::decryptString($log->status),
            ];
        });

        $countAttendance = LogAttendance::count(); // Get total attendance count

        return response()->json([
            'attendance' => $attendance,
            'count' => $countAttendance
        ]);
    }


}