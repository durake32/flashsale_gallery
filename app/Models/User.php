<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'random_id', 'address', 'contact_no','google_id',
        'facebook_id','apple_id','status','remarks','customer_type_id','location_id'
    ];

    protected $attributes = [
        'is_wholesaler' => 0,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
   
    public function getJWTCustomClaims() {
        return [];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class);
    }

    public function getNameAttribute($value){
        return ucwords($value);
    }
}
