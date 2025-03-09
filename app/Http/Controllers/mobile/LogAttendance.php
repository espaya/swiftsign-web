<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\mobile\LogAttendance as MobileLogAttendance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LogAttendance extends Controller
{
    public function newAttendance(Request $request)
    {
        $request->validate([
            'userID' => ['required'],
            'session_id' => ['required'],
            'logged_at' => ['required', 'date'],
            'expires_at' => ['required']
        ], [
            'userID.required' => 'User can not be verified',
            'session_id.required' => 'Attendance session can not be verified',
            'logged_at.required' => 'Current time is required',
            'logged_at.date' => 'Current time is not in the correct format',
            'expires_at.required' => 'Cannot verify attendance'
        ]);

        try 
        {
            DB::beginTransaction();

            $status = $expired = '';

            if($request->logged_at > $request->expires_at)
            {
                $status = "LATE";
                $expired = "YES";
            }
            else
            {
                $status = "SIGNED";
                $expired = "NO";
            }

            // check if user has already logged attendance and it checking out
            $checkedIn = MobileLogAttendance::where('userID', $request->userID)
                ->whereNotNull('logged_at')
                ->whereNull('signed_out_at')
                ->first();

            if($checkedIn)
            {
                // checkout
                $checkedIn->update([
                    'signed_out_at' => Crypt::encryptString($request->signed_out_at),
                ]);
            }
            else 
            {
                // check in
                MobileLogAttendance::create([
                    'userID' => $request->userID,
                    'session_id' => Crypt::encryptString($request->session_id),
                    'logged_at' => Crypt::encryptString($request->logged_at),
                    'signed_out_at' => Crypt::encryptString($request->signed_out_at),
                    'expired' => Crypt::encryptString($expired),
                    'status' => Crypt::encryptString($status),
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Your attendance has been logged successfully'
            ], 200);
        }
        catch(Exception $ex)
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An Unknown Error Occurred: ' . $ex
            ], 500);
        }
    }

    

}
