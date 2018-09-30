<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Models\ShowSeasonEpisodes,
    App\Models\ShowEpisodesRate,
    DB;

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

    public function listEpisodes($dPage = 1){

        $dLimit     = 4;
        $dOffset    = ($dPage-1)*$dLimit;
        $aEpisodes  = \DB::table('show_season_episodes')->skip($dOffset)->take($dLimit)->get();;

        $dCount = ShowSeasonEpisodes::get()->count();
        $dPages = ceil($dCount/$dLimit);

        return view('show.episodesListing', [
            'aEpisodes' => $aEpisodes,
            'dPages' => $dPages,
            'dCurrentPages' => $dPage,
        ]);
    }

    public function index(Request $request){
        $this->middleware('auth');

        return view('dashboard.episodes.index', []);
    }

    public function grid(Request $request){
        $this->middleware('auth');

        $len = $_GET['length'];
        $start = $_GET['start'];

        $select = "SELECT id, season_id, title, description, show_time, thumbnail, video ";
        $presql = " FROM show_season_episodes a ";
        if($_GET['search']['value']) {
            $presql .= " WHERE season_id LIKE '%".$_GET['search']['value']."%' ";
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
