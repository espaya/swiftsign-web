<?php

namespace App\Http\Controllers;

use App\Models\QRCode as ModelsQRCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\DB;

class QRCodeController extends Controller
{
    public function index()
    {

        return view('dashboard.dashboard-qr-code');
    }

    public function searchQrCode(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search term is required'
            ], 400);
        }

        try {
            $qrCodes = DB::table('qrcode')
                ->where('qr_code_name_plaintext', 'LIKE', "%{$query}%")
                ->orWhere('status', 'LIKE', "%{$query}%")
                ->get();

                // Decrypt only if values are not null
            $qrCodes = $qrCodes->map(function ($qr) {
                return [
                    'id' => $qr->id,
                    'qr_code_name' => $qr->qr_code_name ? Crypt::decryptString($qr->qr_code_name) : null,
                    'status' => $qr->status ? Crypt::decryptString($qr->status) : null,
                    'session_id' => $qr->session_id ? $qr->session_id : null,
                    // 'qrcode' => $qr->qrcode ? asset(Crypt::decryptString($qr->qrcode)) : null,
                    'qrcode' => $qr->qrcode ? $qr->qrcode : null,
                    'expires_at' => $qr->checkout_at ? Crypt::decryptString($qr->checkout_at) : null,
                ];
            });
    

            return response()->json($qrCodes, 200);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => 'An Unknown Error Occurred'
            ], 500);
        }
    }

    public function getAllQrCode(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10); // Items per page, default to 10
            $qrCodes = ModelsQRCode::orderBy('id', 'DESC')->paginate($perPage);

            if ($qrCodes->isEmpty()) {
                return response()->json([], 200);
            }

            // Transform each item
            $transformed = $qrCodes->getCollection()->map(function ($qr) {
                $expiresAt = $qr->checkout_at ? Crypt::decryptString($qr->checkout_at) : null;
                $formattedExpiresAt = $expiresAt ? Carbon::parse($expiresAt)->format('jS F Y | h:i A') : null;
                $status = $qr->status ? Crypt::decryptString($qr->status) : null;

                if ($expiresAt) {
                    $status = Carbon::parse($expiresAt)->isPast() ? 'EXPIRED' : 'ACTIVE';
                }

                return [
                    'id' => $qr->id,
                    'qr_code_name' => $qr->qr_code_name ? Crypt::decryptString($qr->qr_code_name) : null,
                    'status' => $status,
                    'session_id' => $qr->session_id,
                    'qrcode' => $qr->qrcode,
                    'expires_at' => $formattedExpiresAt,
                ];
            });

            // Return data with pagination meta
            return response()->json([
                'data' => $transformed,
                'current_page' => $qrCodes->currentPage(),
                'last_page' => $qrCodes->lastPage(),
                'total' => $qrCodes->total(),
                'per_page' => $qrCodes->perPage(),
            ], 200);

        } catch (Exception $ex) {
            Log::error('Error fetching QR codes: ' . $ex->getMessage());
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }


    function pkcs7_pad($data, $blockSize = 16)
    {
        $pad = $blockSize - (strlen($data) % $blockSize);
        return $data . str_repeat(chr($pad), $pad);
    }

    public function createQrCode(Request $request)
    {
        $request->validate([
            'qr_code_name' => ['required','string','max:255', 'unique:qrcode,qr_code_name'],
            'status' => ['required','in:active,deactivated,expired'],
            'check_in_at' => ['required', 'date', 'after:now'],
            'checkout_at' => ['required', 'date', 'after:now', 'different:check_in_at']
        ], [
            'qr_code_name.required' => 'This field is required',
            'qr_code_name.string' => 'Invalid input',
            'qr_code_name.max' => 'Input is too long',
            'qr_code_name.unique' => 'An attendance code with this name already exists',

            'status.required' => 'This field is required',
            'status.in' => 'Invalid input',

            'check_in_at.required' => 'This field is required',
            'check_in_at.date' => 'Invalid input',
            'check_in_at.after' => 'Input must be in the future only',

            'checkout_at.required' => 'This field is required',
            'checkout_at.date' => 'Invalid input',
            'checkout_at.after' => 'Input can only be in the future',
            'checkout_at.different' => 'Checkout can not be same as check in time' 
        ]);

        try
        {
            DB::beginTransaction();

            $session_id = uniqid();
            $timestamp = now()->toISOString();
            // $secretKey = env('APP_KEY');
            $iv = random_bytes(16);

            // Encrypt session data
            $dataToEncrypt = json_encode([
                'session_id' => $session_id,
                'timestamp' => $timestamp,
                'check_in_at' => $request->check_in_at, 
                'checkout_at' => $request->checkout_at 
            ]);

            // $encryptedData = openssl_encrypt($dataToEncrypt, 'aes-256-cbc', $secretKey, 0, $iv);
            $signature = base64_encode($dataToEncrypt);

           // Convert expires_at to minutes from now
            $expiresAt = Carbon::parse($request->checkout_at); 
            $expiresInMinutes = now()->diffInMinutes($expiresAt, false); // `false` prevents negative values

            // Ensure expiration time is not negative (fallback to 5 minutes if past)
            $cacheDuration = max($expiresInMinutes, 5); 

            // Cache session dynamically based on expires_at
            Cache::put("qr_session_{$session_id}", $session_id, now()->addMinutes($cacheDuration));


            // Generate QR Code
            $qrCode = QrCode::create($signature);

            // Generate PNG Image
            $writer = new PngWriter();
            $result = $writer->write($qrCode);


            // Ensure directory exists
            $directory = public_path('qrcodes');

            if (!File::exists($directory)) 
            {
                File::makeDirectory($directory, 0755, true);
            }

            
           // Save QR Code
            $sigName = "{$session_id}.png"; // Only the file name
            $filePath = public_path("qrcodes/{$sigName}");

            // Save the QR code image
            $result->saveToFile($filePath); // ✅ Using Laravel's method instead of file_put_contents

            $checkInAt = Carbon::parse($request->check_in_at)->format('Y-m-d H:i:s');

            // Save to Database
            ModelsQRCode::create([
                'qr_code_name' => Crypt::encryptString($request->qr_code_name),
                'status' => Crypt::encryptString($request->status),
                'session_id' => $session_id,
                'qr_code_name_plaintext' => $request->qr_code_name,
                'check_in_at' => Crypt::encryptString($checkInAt),
                'qrcode' => $sigName,
                'checkout_at' => Crypt::encryptString($request->checkout_at),
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'QR Code Generated Successfully',
            ], 200);
        }
        catch(Exception $ex)
        {
            DB::rollBack();

            Log::error('QR code generation error: ' . $ex->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An Unknown Error Occurred:' . $ex->getMessage(),
                'error' => $ex->getMessage()
            ], 500);
        }
    
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string']
        ], [
            'id.required' => 'Cannot delete this row',
            'id.required' => 'This row does not exist'
        ]);

        try 
        {
            DB::beginTransaction();

            $qrCode = ModelsQRCode::where('id', $request->id)->first();

            if($qrCode)
            {
                // delete file from public/qrcodes
                $qr_code_name = Crypt::decryptString($qrCode->qr_code_name);
                
                $filePath = public_path("qrcodes/$qr_code_name");

                if(File::exists($filePath))
                {
                    File::delete($filePath);
                }

                // delete from db
                $qrCode->delete();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'QR Code deleted successfully'
                ], 200);
            }
            else 
            {
                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => 'QR Code not found'
                ], 404);
            }
        }
        catch(Exception $ex)
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An Unknown Error Occurred'
            ], 500);
        }
    }

}
