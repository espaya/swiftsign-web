<?php

namespace App\Models\mobile;

use Illuminate\Database\Eloquent\Model;

class LogAttendance extends Model
{
    protected $table = 'log_attendance';
    
    protected $fillable = [
        'userID',
        'session_id',
        'logged_at',
        'signed_out_at',
        'expired',
        'status'
    ];
}
