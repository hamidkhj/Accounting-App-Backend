<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveaway extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'group_id',
        'activate_on',
        'interval',
        'creator_id',
        'description',
    ];
}
