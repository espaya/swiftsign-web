<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = [
        'fullname',
        'position',
        'phone',
        'userID',
        'employee_id',
        'pic'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
