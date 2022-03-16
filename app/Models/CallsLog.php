<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_date',
        'nas',
        'port',
        'status',
        'reason',
        'detail',
        'fa_why',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
