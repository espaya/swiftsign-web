<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\mobile\LogAttendance;
use App\Models\QRCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function totalQrCodes()
    {
        try 
        {
            $totalQrCode = QRCode::count();

            if(!$totalQrCode)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'N/A'
                ], 200);
            }

            return response()->json($totalQrCode);
        }
        catch(Exception $ex)
        {
            Log::error('Error getting total QR Codes: ' . $ex);

            return response()->json([
                'success' => false,
                'message' => 'Error getting total QR Codes'
            ], 500);
        }
    }

    public function totalEmployees()
    {
        try 
        {
            $totalEmployee = Employee::count();

            if(!$totalEmployee)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'N/A'
                ], 200);
            }

            return response()->json($totalEmployee);
        }
        catch(Exception $ex)
        {
            Log::Error('Error getting total employee: ' . $ex);

            return response()->json([
                'success' => false,
                'message' => 'Error getting total employee',
            ], 500);
        }
    }

    public function totalAttendances()
    {
        try 
        {
            $totalAttendance = LogAttendance::count();

            if(!$totalAttendance)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'N/A'
                ], 200);
            }

            return response()->json($totalAttendance);
        }
        catch(Exception $ex)
        {
            Log::error('Error getting total attendance: ' . $ex);

            return response()->json([
                'success' => false,
                'message' => 'Error getting total attendance'
            ], 500);
        }
    }

}
