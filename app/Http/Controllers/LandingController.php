<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\Show,
    App\Models\ShowSeasonEpisodes;

class LandingController extends Controller
{
    public function welcome(){

        $aShows = Show::orderBy('id')->take(4)->get();
        $aEpisodes = ShowSeasonEpisodes::orderBy('id')->take(4)->get();
        return view('layouts.landing', [
            'aShows' => $aShows,
            'aEpisodes' => $aEpisodes
        ]);
    }

}
