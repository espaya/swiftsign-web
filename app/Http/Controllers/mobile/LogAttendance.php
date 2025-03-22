<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\mobile\LogAttendance as MobileLogAttendance;
use App\Models\QRCode;
use App\Models\User;
use App\Notifications\NewAttendanceLogNotification;
use Carbon\Carbon;
use DateTime;
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
            'checkout_at' => ['required', 'date'],
            'logged_at' => ['required', 'date']
        ], [
            'userID.required' => 'User can not be verified',

            'session_id.required' => 'Attendance session can not be verified',

            'checkout_at.required' => 'Current time is required',
            'checkout.date' => 'Checkout time is not in the correct format',

            'logged_at.required' => 'Cannot verify attendance',
            'logged_at.date' => 'Check-in time is not in the correct format'
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
            
            $expires_at = $mainQrCode->checkout_at;
            
            // Define status and expired variables
            $status = "SIGNED";
            $expired = "NO";
            
            if (time() >= strtotime($request->checkout_at)) {
                $status = "LATE";
                $expired = "YES";
            }
            

            // Check if the user has already logged attendance
            $checkedIn = MobileLogAttendance::where('userID', $request->userID)
            ->where('session_id', $request->session_id)
            ->whereDate('created_at', now()->toDateString()) // Compare only the date part
            ->first();

            // If the user has already logged attendance
            if ($checkedIn) 
            {
                // If both logged_at and signed_out_at are not empty
                if (!empty($checkedIn->logged_at) && !empty($checkedIn->signed_out_at)) 
                {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Your attendance for this session is complete. Thank you 😊',
                    ], 200);
                }
                // If logged_at is not empty but signed_out_at is empty
                else if (!empty($checkedIn->logged_at) && empty($checkedIn->signed_out_at)) 
                {
                    // Check if the current time is less than the expiration time
                    // Convert $expires_at to a Carbon instance
                    $expiresAt = Carbon::parse(Crypt::decryptString($expires_at));

                    // Compare the current time with the expiration time
                    if (now()->lt($expiresAt)) 
                    {
                        return response()->json([
                            'status' => 'error',
                            'message' => '🖐 You cannot sign out your attendance. Try again later.',
                        ], 400);
                    }

                    $attendance = $checkedIn;

                    // Update the signed_out_at field with the current timestamp
                     $checkedIn->update([
                        'signed_out_at' => Crypt::encryptString(now()->toIso8601String()),
                    ]);

                    $notify = 'update';

                    // play a notification sound before notifying the admin

                    // Notify the admin
                    User::where('role', 'admin')->first()->notify(new NewAttendanceLogNotification($attendance, $checkedIn->userID, $notify));

                    DB::commit();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Attendance signed out successfully',
                    ], 200);
                }
            }
            // If the user has not logged attendance yet, create a new record
            else 
            {
                // Create a new attendance record
                $attendance = MobileLogAttendance::create([
                    'userID' => $request->userID,
                    'session_id' => $request->session_id,
                    'logged_at' => Crypt::encryptString($request->logged_at),
                    'signed_out_at' => '',
                    'expired' => Crypt::encryptString($expired),
                    'status' => Crypt::encryptString($status),
                ]);

                $notify = 'new';

                // Notify the admin
                User::where('role', 'admin')->first()->notify(new NewAttendanceLogNotification($attendance, $attendance->userID, $notify));

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Your attendance has been logged successfully',
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
            $attendances = MobileLogAttendance::where('userID', $id)->orderBy('id', 'DESC')->get();


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
                    ->format('M j, y | g:i A') : 'Not signed out yet',

                    'expired' => $attendance->expired ? Crypt::decryptString($attendance->expired) : null,
                    'status' => $attendance->status ? Crypt::decryptString($attendance->status) : null,
                    'created_at' => $attendance->created_at ? $attendance->created_at : null,
                    'updated_at' =>  $attendance->updated_at ? $attendance->updated_at : null,
                    // Fix: Use `pluck()` to get an array of QR code names
                    'qr_code_names' => $qrcodes ? $qrcodes->map(fn($code) => Crypt::decryptString($code)) : [],  
                ];
            });


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
