<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function messages() {
        return $this->hasMany(Messages::class);
    }
}
