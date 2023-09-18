<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable,HasRoles;

    protected $guard  = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getSuperAdminAttribute()
    {
        if ($this->is_super == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Yes',
            ];
        } else {
            return [
                'status' => 'badge badge-danger',
                'message' => 'No',
            ];
        }
    }
    
    public function getJWTIdentifier() {
        return $this->getKey();
    }
   
    public function getJWTCustomClaims() {
        return [];
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}