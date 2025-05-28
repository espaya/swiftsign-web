<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class mobileAuthController extends Controller
{

    public function recoverAccount(Request $request)
    {
        $request->validate([
            'loginID' => ['required', 'string'],
        ], [
            'loginID.required' => 'This field is required',
            'loginID.string' => 'Invalid input format'
        ]);

        try 
        {
            $loginID = htmlspecialchars(trim($request->loginID, ENT_QUOTES, 'utf-8'));

            $user = User::where('email', $loginID)
                ->orWhere('name', $loginID)
                ->first();

            if($user)
            {
                return response()->json([
                    'success' => true,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->employee->pic
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Your account was not found!'
            ], 404);

        }
        catch(Exception $ex)
        {
            Log::error('An unknown error occurred whilst recovering your account: ' . $ex->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unknown error occurred whilst recovering your account'
            ], 500);
        }

    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',

            'password.required' => 'Please enter your password'
        ]);

        try 
        {
            $email = htmlspecialchars(trim($request->email), ENT_QUOTES, 'utf-8');

            $user = User::withoutTrashed()
                ->where('email', $email)
                ->orWhere('name', $email)
                ->first();

            if (!$user || !Hash::check($request->password, $user->password)) 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User authentication failed!',
                ], 401);
            } 
            
            // Generate API token
            $token = $user->createToken('authToken')->plainTextToken;
            
            return response()->json([
                'status' => 'success',
                'id' => $user->id,   // ✅ Ensure ID is present
                'email' => $user->email,
                'name' => $user->name,
                'token' => $token
            ], 200);            

        } 
        catch (Exception $ex) 
        {
            Log::error('An unknown error occurred whilst authenticating user: ' . $ex->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An unknown error occurred whilst authenticating user',
            ], 500);
        }
    }
}