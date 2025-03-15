<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\mobile\LogAttendance as MobileLogAttendance;
use App\Models\QRCode;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

            // Ensure expires_at is retrieved from the database before using it
            $mainQrCode = QRCode::where('session_id', $request->session_id)->first();
            
            if (!$mainQrCode) 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'QR Code not found for the provided session ID.',
                ], 404);
            }
            
            $expires_at = $mainQrCode->expires_at;
            
            // Define status and expired variables
            $status = "SIGNED";
            $expired = "NO";
            
            if ($request->logged_at > $expires_at) 
            {
                $status = "LATE";
                $expired = "YES";
            }

            // Check if the user has already logged attendance and is checking out
            $checkedIn = MobileLogAttendance::where('userID', $request->userID)
            ->where('session_id', $request->session_id)
            // ->whereNotNull('logged_at')
            // ->whereNull('signed_out_at')
            ->whereDate('created_at', now()->toDateString()) // Compare only the date part
            ->first();

            
            

            // Check if the user has already logged attendance for this session
            $existingAttendance = MobileLogAttendance::where('userID', $request->userID)
                ->where('session_id', $request->session_id)
                ->first();

                Log::error($request->signed_out_at);


            // If the user has already logged attendance and is checking out
            if ($checkedIn && empty($checkedIn->signed_out_at) && !empty($checkedIn->logged_at) && now()->format('Y-m-d H:i:s') > $request->expires_at) 
            {
                $checkedIn->update([
                    'signed_out_at' => Crypt::encryptString($request->signed_out_at),
                ]);
            
                DB::commit();
            
                return response()->json([
                    'status' => 'success',
                    'message' => 'Attendance signed out successfully',
                ], 200);
            } 
            else if (!empty($checkedIn->logged_at) && empty($checkedIn->signed_out_at)) 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have already logged your attendance for this session.',
                ], 400);
            }
            else if(empty($checkedIn->logged_at))
            {
                // Create a new attendance record
                MobileLogAttendance::create([
                    'userID' => $request->userID,
                    'session_id' => $request->session_id,
                    'logged_at' => Crypt::encryptString($request->logged_at),
                    'signed_out_at' => null,
                    'expired' => Crypt::encryptString($expired),
                    'status' => Crypt::encryptString($status),
                ]);
            
                DB::commit();
            
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your attendance has been logged successfully',
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your attendance for today is complete. Thank you',
                ], 200);
            }
        } 
        catch (Exception $ex) 
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An Unknown Error Occurred: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function getAttendance($id)
    {
        try 
        {
            $attendances = MobileLogAttendance::where('userID', $id)->get();


            $decryptedData = $attendances->map(function ($attendance) {
                // Get QR codes associated with the session
                $qrcodes = QRCode::where('session_id', $attendance->session_id)->pluck('qr_code_name');

                return [
                    'id' => $attendance->id ? $attendance->id : null, 
                    'userID' => $attendance->userID ? $attendance->userID : null,
                    'session_id' => $attendance->session_id ? $attendance->session_id : null,

                    'logged_at' => $attendance->logged_at ? Carbon::parse(Crypt::decryptString($attendance->logged_at))
                        ->format('M j, y | g:i A') : null,

                    'signed_out_at' => $attendance->signed_out_at ? Carbon::parse(Crypt::decryptString($attendance->signed_out_at))
                    ->format('M j, y | g:i A') : null,

                    'expired' => $attendance->expired ? Crypt::decryptString($attendance->expired) : null,
                    'status' => $attendance->status ? Crypt::decryptString($attendance->status) : null,
                    'created_at' => $attendance->created_at ? $attendance->created_at : null,
                    'updated_at' =>  $attendance->updated_at ? $attendance->updated_at : null,
                    // Fix: Use `pluck()` to get an array of QR code names
                    'qr_code_names' => $qrcodes ? $qrcodes->map(fn($code) => Crypt::decryptString($code)) : [],  
                ];
            });

            Log::error($decryptedData);

            return response()->json([
                'success' => true,
                'attendance' => $decryptedData
            ], 200);

        }
        catch(Exception $ex)
        {
            Log::error($ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

}
