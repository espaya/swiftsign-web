<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

     /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        try 
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->remember)) 
            {
                $user = Auth::user();

                if ($user->role === 'employee') 
                {
                    Auth::logout(); // Invalidate session
                    return response()->json([
                        'success' => false,
                        'message' => 'Access denied for employees.',
                        'redirect' => url('/'),
                    ], 403);
                }

                return response()->json([
                    'success' => true,
                    'redirect' => url('/dashboard'),
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'User was not found.',
            ], 401);
        }
        catch(Exception $ex)
        {
            Log::error($ex->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }



    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        // Invalidate the session and flush session data
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear browser cache by adding headers
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
            'redirect' => url('/'),
        ], 200)
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')  // Prevent caching
        ->header('Pragma', 'no-cache')  // Older HTTP/1.0 Cache Control
        ->header('Expires', '0')  // Ensure that the browser doesn't cache the response
        ->header('Location', url('/'));  // Redirect to login page
    }


}
