<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

//role and permissions
use jeremykenedy\LaravelRoles\Models\Role;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password', 
        'org_email',
        'last_name',
        'father_name',
        'birthday',
        'address',
        'phone',
        'meli_code',
        'gender',
        'exp_date',
        'hour_limit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Helper functions regarding relations with other models
     *
     * 
     */
    public function role() {
        return $this->belongsToMany(Role::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function packages()
    {
        return $this->hasMany(UserPackage::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function martialStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

}
