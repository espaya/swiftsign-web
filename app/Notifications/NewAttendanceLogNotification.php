<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class NewAttendanceLogNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     protected $attendance;
     protected $userID;
     protected $notify;

    public function __construct($attendance, $userID, $notify)
    {
        $this->attendance = $attendance;
        $this->userID = $userID;
        $this->notify = $notify;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    public function toDatabase($notifiable)
    {
        // Fetch the user's name using the userID
        $user = User::find($this->userID);
        $username = $user ? ucfirst($user->name) : 'Unknown User';

        $message = $timestamp = '';

        // determine the message and timestamp based on the attendance data
        if($this->notify == 'new')
        {
            $message = 'New attendance by ' . $username;
            $timestamp = Crypt::decryptString($this->attendance->logged_at);
        }
        elseif($this->notify == 'update')
        {
            $message = 'Attendance signed out by ' . $username;
            $timestamp = Crypt::decryptString($this->attendance->signed_out_at);
        }
        else 
        {
            // Do nothing 
        }

        return 
        [
            'message' => $message,
            'attendance_id' => $this->attendance->id,
            'timestamp' => $timestamp
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
