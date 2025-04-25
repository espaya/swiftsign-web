<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\mobile\LogAttendance;
use App\Models\QRCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function result()
    {
        $now = Carbon::now();
        $lastWeek = $now->copy()->subWeek();

        $totalQrCode = QRCode::count();
        $totalEmployee = Employee::count();
        $totalAttendance = LogAttendance::count();

        $qrLastWeek = QRCode::where('created_at', '>=', $lastWeek)->count();
        $employeeLastWeek = Employee::where('created_at', '>=', $lastWeek)->count();
        $attendanceLastWeek = LogAttendance::where('created_at', '>=', $lastWeek)->count();

        $qrChange = $this->calculateChange($qrLastWeek, $totalQrCode);
        $employeeChange = $this->calculateChange($employeeLastWeek, $totalEmployee);
        $attendanceChange = $this->calculateChange($attendanceLastWeek, $totalAttendance);

        return response()->json([
            'totals' => [
                'qrCode' => $totalQrCode,
                'employee' => $totalEmployee,
                'attendance' => $totalAttendance,
            ],
            'changes' => [
                'qrCode' => $qrChange,
                'employee' => $employeeChange,
                'attendance' => $attendanceChange,
            ],
        ]);
    }



    // Helper method
    private function getMonthlyData($model)
    { 
        $data = $model::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        // Fill missing months with 0
        $filledData = [];
        for ($i = 1; $i <= 12; $i++) {
            $filledData[] = $data[$i] ?? 0;
        }

        return $filledData;
    }


    private function calculateChange($previous, $current)
    {
        if ($current == 0) return 0;
        $diff = $current - $previous;
        return round(($diff / $current) * 100, 1);
    }

    // public function totalQrCodes()
    // {
    //     try 
    //     {
    //         $totalQrCode = QRCode::count();

    //         if(!$totalQrCode)
    //         {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'N/A'
    //             ], 200);
    //         }

    //         return response()->json($totalQrCode);
    //     }
    //     catch(Exception $ex)
    //     {
    //         Log::error('Error getting total QR Codes: ' . $ex);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error getting total QR Codes'
    //         ], 500);
    //     }
    // }

    // public function totalEmployees()
    // {
    //     try 
    //     {
    //         $totalEmployee = Employee::count();

    //         if(!$totalEmployee)
    //         {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'N/A'
    //             ], 200);
    //         }

    //         return response()->json($totalEmployee);
    //     }
    //     catch(Exception $ex)
    //     {
    //         Log::Error('Error getting total employee: ' . $ex);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error getting total employee',
    //         ], 500);
    //     }
    // }

    // public function totalAttendances()
    // {
    //     try 
    //     {
    //         $totalAttendance = LogAttendance::count();

    //         if(!$totalAttendance)
    //         {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'N/A'
    //             ], 200);
    //         }

    //         return response()->json($totalAttendance);
    //     }
    //     catch(Exception $ex)
    //     {
    //         Log::error('Error getting total attendance: ' . $ex);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error getting total attendance'
    //         ], 500);
    //     }
    // }

}
