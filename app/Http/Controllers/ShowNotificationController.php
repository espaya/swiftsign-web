<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewAttendanceLogNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowNotificationController extends Controller
{
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
