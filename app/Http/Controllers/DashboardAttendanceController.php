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

    public function getAllAttendance(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 per page
        $attendancePaginated = LogAttendance::orderBy('id', 'desc')->paginate($perPage);

        // Transform paginated data
        $attendanceData = $attendancePaginated->getCollection()->map(function ($log) {
            $employee = Employee::where('userID', $log->userID)->first();

            $loggedAt = Crypt::decryptString($log->logged_at);
            $formattedLoggedAt = Carbon::parse($loggedAt)->format('jS F Y | h:i A');

            $signedOutAt = $log->signed_out_at ? Crypt::decryptString($log->signed_out_at) : 'Not Available';
            $formattedSignedOutAt = $signedOutAt !== 'Not Available' ? Carbon::parse($signedOutAt)->format('jS F Y | h:i A') : 'Not Available';

            return [
                'id' => $log->id,
                'session_id' => $log->session_id,
                'userID' => $log->userID,
                'fullname' => $employee ? Crypt::decryptString($employee->fullname) : 'Unknown',
                'logged_at' => $formattedLoggedAt,
                'signed_out_at' => $formattedSignedOutAt,
                'expired' => $log->expired ? Crypt::decryptString($log->expired) : null,
                'status' => Crypt::decryptString($log->status),
            ];
        });

        return response()->json([
            'attendance' => $attendanceData,
            'pagination' => [
                'current_page' => $attendancePaginated->currentPage(),
                'last_page' => $attendancePaginated->lastPage(),
                'per_page' => $attendancePaginated->perPage(),
                'total' => $attendancePaginated->total()
            ]
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
            Log::error($ex);

            return response()->json([
                'success' => false,
                'message' => 'Unknown Error Occurred',
            ], 500);
        }
    }

}