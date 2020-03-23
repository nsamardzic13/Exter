<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{

    protected $guarded = [];

    public function getEndedAttribute($attribute){
		return [
			0 => 'Upcoming',
			1 => 'Ended'
		][$attribute];
	}

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();;
    }
}
