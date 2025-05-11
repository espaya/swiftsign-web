<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard-settings');
    }

    public function updateEmailUser(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email']
        ], [
            'name.required' => 'This field is required',
            'name.string' => 'Invalid input',
            'name.min' => 'Username is too short',
            'email.required' => 'This field is required',
            'email.email' => 'Invalid email'
        ]);
    
        try {
            DB::beginTransaction();
    
            $email = htmlspecialchars(trim($request->email), ENT_QUOTES, 'utf-8');
            $name = htmlspecialchars(trim($request->name), ENT_QUOTES, 'utf-8');
    
            $user->email = $email;
            $user->name = $name;
    
            if($user->isDirty()) 
            {
                $user->save();
                DB::commit();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Account Updated successfully'
                ], 200);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'No Changes Detected'
            ], 304);
        } 
        catch(Exception $ex) 
        {
            DB::rollBack();
            Log::error('Unknown error occurred whilst updating account: ' . $ex->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Unknown error occurred whilst updating account'
            ], 500);
        }
    }
    

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Current password is incorrect.');
                    }
                }
            ],
            'new_password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
            ],
            'confirm_password' => ['nullable', 'same:new_password'],
        ], [
            'old_password.required' => 'This field is required',
            'new_password.required' => 'This field is required',
            'new_password.min' => 'Password is too short',
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            'confirm_password.same' => 'Passwords do not match.',
        ]);
        

        try 
        {
            DB::beginTransaction();

            if (!Hash::check($request->old_password, Auth::user()->password)) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.'
                ], 422);
            }

            $user->password = Hash::make($request->new_password);

            $user->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ], 200);

        }
        catch(Exception $ex)
        {
            DB::rollBack();
            Log::error('Error updating password: ' . $ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => '',
            ]);
        }
    }
}
