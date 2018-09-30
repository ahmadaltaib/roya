<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

use DB;

class UsersController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
	    return view('dashboard.users.index', []);
	}

	public function grid(Request $request){
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT id, name, email, type ";
		$presql = " FROM users a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
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