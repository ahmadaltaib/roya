<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowFollow extends Model{

    protected $table = 'user_show_follow';

    public function show(){
        return $this->belongsTo('App\Models\Show',"show_id","id");
    }

    public function followers(){
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }
}
