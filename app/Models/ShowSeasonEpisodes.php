<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowSeasonEpisodes extends Model
{
    public function season(){
        return $this->belongsTo('App\Models\ShowSeason',"season_id","id");
    }

    public function rates(){
        return $this->hasMany('App\Models\ShowEpisodesRate', 'episode_id', 'id');
    }
}
