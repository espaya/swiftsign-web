<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $table = 'qrcode';

    protected $fillable = [
        'qr_code_name',
        'status',
        'session_id',
        'qrcode',
        'expires_at',
        'qr_code_name_plaintext',
        'checkout_at'
    ];
}
