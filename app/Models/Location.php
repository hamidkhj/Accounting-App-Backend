<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'address', 'city', 'phone1', 'phone2', 'location_type_id'];


    public function ips()
    {
        return $this->hasMany(Ip::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function types () {
        return $this->belongsTo(LocationType::class);
    }
}
