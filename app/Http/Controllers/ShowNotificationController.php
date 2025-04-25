<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewAttendanceLogNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShowNotificationController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $notifications = $admin->notifications()->paginate(request('per_page', 10));
        
        return view('dashboard.dashboard-notification', [
            'notifications' => $notifications,
            'perPage' => request('per_page', 10)
        ]);
    }

    public function destroy($id)
    {
        try 
        {
            $admin = Auth::user();
            
            // Corrected: Use 'notifications()' relationship instead of 'notification()'
            $notification = $admin->notifications()->where('id', $id)->first();

            if (!$notification) {
                return redirect()->back()->with('error', 'Notification not found');
            }

            $notification->delete();

            return redirect()->back()->with('success', 'Notification deleted successfully');
            
        } 
        catch (\Exception $ex) 
        {
            // Added proper exception type hint and logging
            Log::error('Error deleting notification: ' . $ex->getMessage());
            return redirect()->back()->with('error', 'Failed to delete notification');
        }
    }

    public function showUnreadNotification() 
    {
        $admin = Auth::user();

        $unreadNotifications = $admin->unreadNotifications;

        return response()->json([
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if($notification)
        {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read']);
        }

        return response()->json(['message' => 'Notification not found'], 404);

    }

}
