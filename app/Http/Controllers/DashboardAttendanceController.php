<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\mobile\LogAttendance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardAttendanceController extends Controller
{
    // attendance method for admin
    public function index()
    {
        return view('dashboard.dashboard-attendance');
    }

    public function getAllAttendance()
    {
        // Fetch attendance data ordered by id in descending order
        $attendance = LogAttendance::orderBy('id', 'desc')->get()->map(function ($log) {
            $employee = Employee::where('userID', $log->userID)->first(); // Fetch employee

            // Decrypt logged_at and format it
            $loggedAt = Crypt::decryptString($log->logged_at);
            $formattedLoggedAt = Carbon::parse($loggedAt)->format('jS F Y | h:i A');

            // Decrypt signed_out_at and format it
            $signedOutAt = $log->signed_out_at ? Crypt::decryptString($log->signed_out_at) : 'Not Available';
            $formattedSignedOutAt = $signedOutAt !== 'Not Available' ? Carbon::parse($signedOutAt)->format('jS F Y | h:i A') : 'Not Available';

            return [
                'id' => $log->id,
                'session_id' => $log->session_id,
                'userID' => $log->userID,
                'fullname' => $employee ? Crypt::decryptString($employee->fullname) : 'Unknown',
                'logged_at' => $formattedLoggedAt, // Formatted logged_at
                'signed_out_at' => $formattedSignedOutAt, // Formatted signed_out_at
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

    public function destroy($id)
    {
        try 
        {
            $findAttendance = LogAttendance::where('id', $id)->first();

            if(!$findAttendance)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Could not find record'
                ], 404);
            }

            $findAttendance->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ], 200);
        }
        catch(Exception $ex)
        {
            Log::error($ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unknown Error Occurred',
            ], 500);
        }
    }

}