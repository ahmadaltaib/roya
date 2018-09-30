<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\Show,
    App\Models\ShowSeason,
    App\Models\ShowFollow,
    DB;

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

        return view('show.showListing', [
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

    public function index(Request $request){

        $this->middleware('auth');

        return view('dashboard.shows.index', []);
    }

    public function grid(Request $request){

        $this->middleware('auth');

        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT id, title, description, show_time, thumbnail ";
        $presql = " FROM shows a ";
        if($_GET['search']['value']) {
            $presql .= " WHERE title LIKE '%".$_GET['search']['value']."%' ";
        }

        $presql .= "  ";

        $sql = $select.$presql." LIMIT ".$start.",".$len;


        $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
        //print_r($qcount);
        $count = $qcount[0]->c;

        $results = DB::select($sql);
        $ret = [];
        foreach ($results as $row) {
            $r = [];
            foreach ($row as $value) {
                $r[] = $value;
            }
            $ret[] = $r;
        }

        $ret['data'] = $ret;
        $ret['recordsTotal'] = $count;
        $ret['iTotalDisplayRecords'] = $count;

        $ret['recordsFiltered'] = count($ret);
        $ret['draw'] = $_GET['draw'];

        echo json_encode($ret);

    }

}
