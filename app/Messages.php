<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function occasion() {
        return $this->belongsTo(Occasion::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
