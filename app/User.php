<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'birth_year', 'street_name', 'city_name', 'zip_code', 'phone_number', 'description', 'profile_pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sport(){
        return $this->hasOne(Sport::class);
    }

    public function availability(){
        return $this->hasOne(Availability::class);
    }

    public function hangout(){
        return $this->hasOne(Hangout::class);
    }

    public function occasions(){
        return $this->hasMany(Occasion::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
}
