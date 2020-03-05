<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getTableColumns(){
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
