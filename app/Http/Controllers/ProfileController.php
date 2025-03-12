<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function getUsernameEmail($id)
    {
        $emailUsername = User::where('id', $id)->get();

        return response()->json($emailUsername); 
    }

    public function updateUsernameEmail(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email']
        ], [
            'name.required' => 'This field is required',
            'name.string' => 'This field is invalid',
            'email.required' => 'This field is required',
            'email.email' => 'Invalid email format'
        ]);

        try 
        {
            DB::beginTransaction();

            $findUser = User::find($id);

            if (!$findUser) 
            {
                return response()->json(['status' => 'error', 'message' => 'User was not found'], 404);
            }

            // Update the fields that where changed
            $findUser->fill([
                'name' => $request->name,
                'email' => $request->email
            ]);

            // Check if anything has changed before saving
            if (!$findUser->isDirty()) 
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No Changes Were Made'
                ], 200);
            }

            
            $findUser->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User Updated Successfully'
            ], 200);

        } 
        catch (Exception $ex) 
        {
            DB::rollBack();

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An unknown error occurred: '
            ], 500);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ]
        ], [
            'old_password.required' => 'Old password is required',
            'new_password.required' => 'New password is required',
            'new_password.regex' => 'Password must be at least 8 characters long, include one uppercase letter, one number, and one special character'
        ]);

        try 
        {
            DB::beginTransaction();

            $findUser = User::find($id);

            if (!$findUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User Not Found'
                ], 404);
            }

            // Check if the old password matches the stored password
            if (!Hash::check($request->old_password, $findUser->password)) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Incorrect old password'
                ], 422);
            }

            // check if old and new password are same then throw an error
            if(Hash::check($request->new_password, $findUser->password))
            {
                return response()->json([
                    'success' => false,
                    'message' => 'New password cannot be same as the existing password'
                ], 422);
            }

            // Hash the new password before saving
            $findUser->password = Hash::make($request->new_password);

            if (!$findUser->isDirty()) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'No Changes Were Made'
                ], 200);
            }

            $findUser->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ], 200);

        } 
        catch (Exception $ex) 
        {
            DB::rollBack();
            Log::error($ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unknown Error Occurred'
            ], 500);
        }
    }

    public function updateProfilePicture(Request $request, $id)
    {
        $request->validate([
            'fileUpload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try 
        {
            // Find employee
            $findEmployee = Employee::where('userID', $id)->first();

            // If employee not found
            if (!$findEmployee) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found!'
                ], 404);
            }

            // File path
            $filePath = public_path('/uploads/profile_pictures');

            // Create directory if not exists
            if (!file_exists($filePath)) 
            {
                mkdir($filePath, 0777, true);
            }

            // ** Delete old profile picture if it exists **
            if (!empty($findEmployee->pic) && file_exists($filePath . '/' . $findEmployee->pic)) 
            {
                unlink($filePath . '/' . $findEmployee->pic);
            }

            // Upload new image
            $image = $request->file('fileUpload');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($filePath, $imageName); // Save new image

            // Update employee record
            $findEmployee->update(['pic' => $imageName]);

            return response()->json([
                'success' => true,
                'imageUrl' => asset("uploads/profile_pictures/$imageName") // Return full URL
            ], 200);
        } 
        catch (Exception $ex) {
            Log::error($ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unknown Error Occurred',
            ], 500);
        }
    }

    public function getProfilePicture($id)
    {
        try 
        {
            $findEmployee = Employee::where('userID', $id)->first();

            if (!$findEmployee) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found!'
                ], 404);
            }

            // If user has no profile picture, return default image
            if (!$findEmployee->pic) 
            {
                return response()->json([
                    'success' => true,
                    'imageUrl' => asset('img/Sample_User_Icon.png') // Default profile image
                ]);
            }

            $imageUrl = asset('uploads/profile_pictures/' . $findEmployee->pic);

            return response()->json([
                'success' => true,
                'imageUrl' => $imageUrl
            ]);

        } 
        catch (Exception $ex) 
        {
            Log::error($ex->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An Unknown Error Occurred',
            ], 500);
        }
    }


}
