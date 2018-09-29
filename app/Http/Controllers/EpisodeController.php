<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\ShowSeasonEpisodes,
    App\Models\ShowEpisodesRate;

class EpisodeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function episodeDetails($dId){

        $aDetails = ShowSeasonEpisodes::find($dId);
        $aRate = (\Auth::user())?ShowEpisodesRate::whereHas('episode')->where('user_id', \Auth::user()->id)->where('episode_id', $dId)->get():array();

        return view('show.episode', [
            'aDetails' => $aDetails,
            'aRate'    => $aRate
        ]);
    }

    public function rate(){

        $oRate              = new ShowEpisodesRate;
        $oRate->user_id     = \Auth::user()->id;
        $oRate->episode_id  = request('episode_id');
        $oRate->rate        = request('rate');
        $oRate->save();

        $response = array(
            'status' => $oRate->save(),
            'id'     => $oRate->id
        );
        return response()->json($response);
    }

    public function undoRate(){

        $oRate = ShowEpisodesRate::find(request('rate_id'));

        $response = array(
            'status' => $oRate->delete(),
        );
        return response()->json($response);
    }
}
