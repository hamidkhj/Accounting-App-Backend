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
        'group_id',
        'title_id',
        'role_id',
        'marital_status_id',
        'user_name',
        'first_name',
        'last_name',
        'father_name',
        'birthday',
        'address',
        'phone',
        'personal_code',
        'gender',
        'meli_code',
        'email',
        'org_email',
        'is_active',
        'password',
        'major',
        'passport',
        'mobile1',
        'mobile2',
        'comment',
        'picture',
        'city',
        'exp_date',
        'ip_exp_date',
        'static_ip',
        'hour_limit',
        'connection_number',
        'mac_address',
        'bandwidth_limit',
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

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function martialStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function userPackages () {
        return $this->hasMany(UserPackage::class);
    }

}
