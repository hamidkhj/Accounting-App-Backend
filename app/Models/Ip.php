<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = ['location_id', 'name', 'ip'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
