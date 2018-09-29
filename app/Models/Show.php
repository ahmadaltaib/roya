<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model{

    public function seasons(){
        return $this->hasMany('App\Models\ShowSeason', 'show_id', 'id');
    }

    public function followers(){
        return $this->hasMany('App\Models\ShowFollow', 'show_id', 'id');
    }
}
