<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sender_id',
        'content',
        'title',
    ];

    protected $hidden = [
        'id', 
        'user_id',
        'sender_id',
    ];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
