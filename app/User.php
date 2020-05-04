<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Followable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'password', 'user_type', 'birth_year', 'street_name', 'lat',
        'lng', 'phone_number', 'description', 'profile_pic', 'user_gallary', 'provider', 'provider_id',
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
        return $this->belongsToMany(Occasion::class)->withTimestamps();
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function messages(){
        return $this->hasMany(Messages::class);
    }

    public function like() {
        return $this->belongsToMany(Messages::class, 'likes');
    }
}
