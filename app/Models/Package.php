<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_type_id',
        'name',
        'description',
        'duration',
        'size',
        'price',
        'is_for_sale',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }

}
