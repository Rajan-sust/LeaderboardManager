<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SingleContestController extends Controller {

    public function show($id) {

        if(Auth::check() == false) {
            return redirect('/');

        }
        if(DB::table('ranklists')->where('contest_id',$id)->exists()) {
            return view('user/single_contest')->with('id',$id);
        }else{
            return abort(404);
        }
    }

}
