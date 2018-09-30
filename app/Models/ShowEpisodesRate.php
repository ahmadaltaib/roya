<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowEpisodesRate extends Model{

    protected $table = 'user_episode_rate';

    public function user(){
        return $this->belongsTo('App\Models\User',"user_id","id");
    }

    public function episode(){
        return $this->belongsTo('App\Models\ShowSeasonEpisodes',"episode_id","id");
    }
}
