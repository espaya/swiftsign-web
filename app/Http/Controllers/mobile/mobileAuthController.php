<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class mobileAuthController extends Controller
{
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
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid email or password',
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
            return response()->json([
                'status' => 'error',
                'message' => 'An unknown error occurred: ' . $ex->getMessage(),
            ], 500);
        }
    }
}