<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            if (!$findUser) {
                return response()->json(['status' => 'error', 'message' => 'User was not found'], 404);
            }

            // Update the fields
            $findUser->name = $request->name;
            $findUser->email = $request->email;

            // Check if anything has changed before saving
            if ($findUser->isDirty()) {
                $findUser->save();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User Updated Successfully'
            ], 200);

        } 
        catch (Exception $ex) 
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An unknown error occurred: ' . $ex->getMessage()
            ], 500);
        }
    }

}
