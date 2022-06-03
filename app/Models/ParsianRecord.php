<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParsianRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'sale_order_id',
        'price',
        'token',
        'status',
        'message',
        'RNN',
    ];
}
