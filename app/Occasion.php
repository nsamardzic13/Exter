<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{

    protected $guarded = [];
    protected $dates = ['start', 'end'];

    public function getEndedAttribute($attribute){
		return [
			0 => 'Upcoming',
			1 => 'Ended'
		][$attribute];
	}

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function messages() {
        return $this->hasMany(Messages::class);
    }


}
