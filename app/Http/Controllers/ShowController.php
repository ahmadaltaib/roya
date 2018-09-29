<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\Show,
    App\Models\ShowSeason,
    App\Models\ShowFollow;

class ShowController extends Controller{

    public function showDetails($dId){
        $aDetails  = Show::find($dId);
        $aFollower = (\Auth::user())?ShowFollow::whereHas('followers')->where('user_id', \Auth::user()->id)->where('show_id', $dId)->get():array();

        return view('show.show', [
            'aDetails'   => $aDetails,
            'aFollower'  => $aFollower,
        ]);
    }

    public function seasonDetails($dId, $dSeason = 1){

        $aDetails = ShowSeason::find($dSeason);
        return view('show.seasons', [
            'aDetails' => $aDetails,
            'dSeason'  => $dSeason
        ]);
    }

    public function listShows($dPage = 1){

        $dLimit     = 4;
        $dOffset    = ($dPage-1)*$dLimit;
        $aShow      = \DB::table('shows')->skip($dOffset)->take($dLimit)->get();;

        $dCount = Show::get()->count();
        $dPages = ceil($dCount/$dLimit);

        return view('show.listing', [
            'aShows' => $aShow,
            'dPages' => $dPages,
            'dCurrentPages' => $dPage,
        ]);
    }

    public function follow(){
        $oShowFollow = new ShowFollow;
        $oShowFollow->user_id = \Auth::user()->id;
        $oShowFollow->show_id = request('show_id');

        $response = array(
            'status' => $oShowFollow->save(),
            'id' => $oShowFollow->id
        );
        return response()->json($response);
    }

    public function unFollow(){
        $dId = request('id');
        $oFollow = ShowFollow::find($dId);

        $response = array(
            'status' => $oFollow->delete(),
        );
        return response()->json($response);
    }

}
