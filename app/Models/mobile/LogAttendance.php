<?php

namespace App\Models\mobile;

use App\Models\QRCode;
use App\Models\User;
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

    public function qrcode()
    {
        return $this->belongsTo(QRCode::class, 'session_id', 'session_id');
    }

    public function attendance()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }


}
