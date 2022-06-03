<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'package_size', 'hour_limit', 'web_service'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // public function packages()
    // {
    //     return $this->belongsToMany(Package::class);
    // }
}
