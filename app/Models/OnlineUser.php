<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calling_station_id',
        'framed_ip_address',
        'logdate',
        'log_time',
        'acct_session_time',
        'interim_upload',
        'interim_download',
        'service',
        'nas_ip_address',
        'called_station_id',
        'nas_port',
        'acct_unique_session_id',
        'acct_session_id',
        'radius_ip_address',
        'to_be_deleted',
    ];


    protected $hidden = [
        'user_id', 
        'created_at', 
        'updated_at',
        'service',
        'nas_ip_address',
        'called_station_id',
        'nas_port',
        'acct_unique_session_id',
        'acct_session_id',
        'radius_ip_address',
        'to_be_deleted',
    ];
}
