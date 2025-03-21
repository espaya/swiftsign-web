<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MobileAccountController extends Controller
{

    public function getProfilePicture($id)
    {
        if(!$id)
        {
            return response()->json([
                'success' => false,
                'message' => 'Can not validate this user'
            ], 422);
        }

        try 
        {
            $employee = Employee::where('userID', $id)->first();
            
            if (!$employee) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User was not found'
                ], 404);
            }

            $img = $employee->pic;

            // Debugging: Print the file path
            $filePath = public_path('uploads/profile_pictures/' . $img);


            // Check if the file exists
            if (!file_exists($filePath)) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Image file not found'
                ], 404);
            }

            // Generate the public URL for the image
            $image_url = asset('uploads/profile_pictures/' . $img);
            

            return response()->json([
                'success' => true,
                'image_url' => $image_url
            ], 200);

        } catch (Exception $ex) {
            Log::error("Error: " . $ex->getMessage());
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    public function updateProfilePic(Request $request)
    {
        // Validate the request
        $request->validate([
            'userID' => ['required'],
            'img' => ['required', 'image', 'max:5120'] // Accept all image types, max size 5MB
        ]);

        try {
            DB::beginTransaction();

            // Fetch the employee record
            $employee = Employee::where('userID', $request->userID)->first();

            if (!$employee) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'error' => 'User not found'
                ], 404);
            }

            // Define upload directory
            $uploadDir = public_path('uploads/profile_pictures');

            // Ensure the upload directory exists
            if (!file_exists($uploadDir)) 
            {
                mkdir($uploadDir, 0777, true); // Create directory with full permissions
            }

            // Handle image upload
            if ($request->hasFile('img')) 
            {
                $image = $request->file('img');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Unique filename

                // Delete old image if it exists
                if ($employee->pic && file_exists($uploadDir . '/' . $employee->pic)) {
                    unlink($uploadDir . '/' . $employee->pic); // Delete the old image
                }

                // Save the new image to the directory
                $image->move($uploadDir, $imageName);

                // Update the employee record with the new image filename
                $employee->pic = $imageName;
                $employee->save();
            }

            DB::commit();

            // Return success response with the new image URL
            return response()->json([
                'success' => true,
                'message' => 'Profile Picture Updated Successfully',
            ], 200);

        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 500);
        }
    }

    public function updateUsernameEmail(Request $request)
    {
        Log::error($request->userID);

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->userID, 'id'),
            ],
            'username' => [
                'required',
                'string',
                Rule::unique('users', 'name')->ignore($request->userID, 'id'),
            ],
            'userID' => ['required'],
        ]);

        $userID = $request->userID;

        try 
        {
            DB::beginTransaction();
    
            // Find the user
            $user = User::find($userID)->first();
    
            if (!$user) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }
    
            // Update fields conditionally
            $user->fill([
                'name' => $request->username,
                'email' => $request->email
            ]);
    
            // Save the user
            if($user->isDirty())
            {
                $user->save();
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Update Successful',
            ], 200);
        } 
        catch (Exception $ex) 
        {
            DB::rollBack();
    
            // Log the error for debugging
            Log::error('Error updating user: ' . $ex);
    
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    
    }

}
