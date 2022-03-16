<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_date',
        'gateway',
        'line',
        'address',
        'duration',
        'bytes_in',
        'bytes_out',
        'connect_speed',
        'disc_cause',
        'disc_cause_ext',
        'connection_flag',
        'details',
    ];
}
