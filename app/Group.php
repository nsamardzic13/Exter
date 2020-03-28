<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model{

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function messages() {
        return $this->hasMany(Messages::class);
    }
}
