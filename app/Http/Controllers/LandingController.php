<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\Show;

class LandingController extends Controller
{
    public function welcome(){

        $aShows = Show::orderBy('id')->take(4)->get();
        return view('landing', [
            'aShows' => $aShows
        ]);
    }

}
