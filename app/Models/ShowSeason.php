<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowSeason extends Model
{
    public function show(){
        return $this->belongsTo('App\Models\Show',"show_id","id");
    }

    public function episodes(){
        return $this->hasMany('App\Models\ShowSeasonEpisodes', 'season_id', 'id');
    }
}
