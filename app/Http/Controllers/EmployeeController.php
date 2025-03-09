<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'DESC')->get()->map(function ($employee) {
            return [
                'id' => $employee->id,
                'fullname' => Crypt::decryptString($employee->fullname),
                'position' => Crypt::decryptString($employee->position),
                'phone' => Crypt::decryptString($employee->phone),
                'employee_id' => Crypt::decryptString($employee->employee_id),
                'userID' => $employee->userID
            ];
        });        
    
        return response()->json(['employees' => $employees]);
    }

    public function save(Request $request)
    {
        $request->validate([

            'fullname' => ['required', "regex:/^[A-Za-z\s\'-]+$/"],

            'employee_id' => ['required', 'string', 'unique:employee,employee_id'],

            'phone' => ['required', 'regex:/^[0-9]{10,15}$/', 'unique:employee,phone'],

            'position' => ['required', 'regex:/^[A-Za-z\s\-]+$/'], // Allow hyphens in position
        
            'name' => [
                'required', 
                'min:3', 
                'regex:/^(?!admin$|administrator$|author$|editor$|moderator$)[A-Za-z0-9_.]{3,}$/i', 
                'unique:users,name'
            ],

            'email' => ['required', 'email', 'unique:users,email'],

            'password' => [
                'required', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            
            'confirm_password' => ['required', 'same:password'] // Removed regex rule
        ], [
            'fullname.required' => 'This field is required',
            'fullname.regex' => 'Invalid name',
        
            'phone.required' => 'This field is required',
            'phone.regex' => 'Invalid phone number',
            'phone.unique' => 'You cannot use this phone',
        
            'position.required' => 'This field is required',
            'position.regex' => 'Invalid position',
        
            'name.required' => 'This field is required',
            'name.min' => 'Username is too short',
            'name.regex' => 'Invalid username',
            'name.unique' => 'You cannot use this username',
        
            'email.required' => 'This field is required',
            'email.email' => 'Invalid email',
            'email.unique' => 'You cannot use this email',
        
            'password.required' => 'This field is required',
            'password.regex' => 'Invalid password',
        
            'confirm_password.required' => 'This field is required',
            'confirm_password.same' => 'Passwords do not match', // Fixed key from regex to same

            'employee_id.required' => 'This field is required',
            'employee_id.string' => 'Invalid Employee ID'
        ]);

        
        try 
        {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if($user)
            {
                Employee::create([
                    'fullname' => Crypt::encryptString($request->fullname),
                    'phone' => Crypt::encryptString($request->phone),
                    'position' => Crypt::encryptString($request->position),
                    'employee_id' => Crypt::encryptString($request->employee_id),
                    'userID' => $user->id
                ]); 
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee Added Successfully'
            ], 200);
        }
        catch(Exception $ex)
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    public function view($uid)
    {
        $employee = Employee::where('userID', $uid)->first();
        
        return view('dashboard.dashboard-single-employee', [
            'employee' => $employee
        ]);
    }

    public function getEmployee($uid)
    {
        $employees = Employee::where('userID', $uid)->get()->map(function ($employee) {
            return [
                'id' => $employee->id,
                'fullname' => Crypt::decryptString($employee->fullname),
                'position' => Crypt::decryptString($employee->position),
                'phone' => Crypt::decryptString($employee->phone),
                'employee_id' => Crypt::decryptString($employee->employee_id),
                'userID' => $employee->userID
            ];
        });        
    
        return response()->json(['employees' => $employees]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => ['required', "regex:/^[A-Za-z\s\'-]+$/"],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/', Rule::unique('employee', 'phone')->ignore($id)],
            'position' => ['required', 'regex:/^[A-Za-z\s\-]+$/'], // Allow hyphens in position
            'employee_id' => ['required', 'string']
        ], [
            'fullname.required' => 'This field is required',
            'fullname.regex' => 'This field is invalid',

            'position.required' => 'This field is required',
            'position.regex' => 'This field is invalid',

            'phone.required' => 'This field is required',
            'phone.regex' => 'This field is invalid',

            'employee_id.required' => 'This field is required',
            'employee_id.string' => 'Invalid Employee ID'
        ]);

        DB::beginTransaction();

        try {
            // Find the employee
            $employee = Employee::where('userID', $id)->first();

            // Check if the employee exists
            if (!$employee) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee not found'
                ], 404);
            }

            // Decrypt existing values
            $old_fullname = Crypt::decryptString($employee->fullname);
            $old_phone = Crypt::decryptString($employee->phone);
            $old_position = Crypt::decryptString($employee->position);
            $old_employee_id = Crypt::decryptString($employee->employee_id);

            // Encrypt new values
            $new_fullname = Crypt::encryptString($request->fullname);
            $new_phone = Crypt::encryptString($request->phone);
            $new_position = Crypt::encryptString($request->position);
            $new_employee_id = Crypt::encryptString($request->employee_id);

            // Check if any changes were made
            if (
                $old_fullname !== $request->fullname ||
                $old_phone !== $request->phone ||
                $old_position !== $request->position ||
                $old_employee_id !== $request->employee_id
            ) {
                // Update the employee
                $employee->fullname = $new_fullname;
                $employee->phone = $new_phone;
                $employee->position = $new_position;
                $employee->employee_id = $new_employee_id;
                $employee->save();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Employee Updated Successfully'
                ], 200);
            } else {
                DB::commit(); // Commit even if no changes were made
                return response()->json([
                    'status' => 'info',
                    'message' => 'No changes detected'
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an error
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = strtolower($request->input('search'));

    $employees = Employee::all()->map(function ($employee) use ($query) {
        try {
            $fullname = strtolower(Crypt::decryptString($employee->fullname));
            $position = strtolower(Crypt::decryptString($employee->position));
            $employee_id = strtolower(Crypt::decryptString($employee->employee_id));
            $phone = strtolower(Crypt::decryptString($employee->phone));

            if (str_contains($fullname, $query) ||
                str_contains($position, $query) ||
                str_contains($employee_id, $query) ||
                str_contains($phone, $query)) {
                return [
                    'fullname' => $fullname,
                    'position' => $position,
                    'employee_id' => $employee_id,
                    'phone' => $phone,
                    'userID' => $employee->userID,
                    'id' => $employee->id,
                ];
            }
        } catch (\Exception $e) {
            return null; // Skip records if decryption fails
        }
    })->filter(); // Remove null values

    return response()->json(['employees' => $employees]);
    }
}
