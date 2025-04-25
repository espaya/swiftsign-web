<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

    public function updateUsernameEmail(Request $request, $id)
    {
        try 
        {
            $validated = $request->validate([
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($id),
                ],
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users', 'name')->ignore($id),
                ],
            ]);

            return DB::transaction(function () use ($validated, $id) {
                $user = User::findOrFail($id);

                $user->name = $validated['name'];
                $user->email = $validated['email'];

                if ($user->isDirty()) 
                {
                    $user->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Profile updated successfully',
                        'data' => [
                            'name' => $user->name,
                            'email' => $user->email,
                        ]
                    ], 200);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'No changes detected',
                ], 200);
            });
        } 
        catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } 
        catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        } 
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile. Please try again.',
            ], 500);
        }
    }


}
