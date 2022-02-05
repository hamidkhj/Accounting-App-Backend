<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'address', 'city', 'phone1', 'phone2'];

    public function locations () {
        return $this->hasMany(Location::class);
    }
}
