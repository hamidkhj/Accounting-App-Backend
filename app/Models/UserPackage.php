<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'expiration_date',
        'megabyte',
        'priority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
