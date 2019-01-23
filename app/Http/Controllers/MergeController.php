<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MergeController extends Controller {

    public function show() {

        if(Auth::check() == false) {
            return redirect('/');
        }
        if(Auth::user()->admin == true) {
            return view('admin/exp_merge_checkbox');

        }else{
            return abort('401');
        }

    }

    public function receive() {

        $all_contests_id = DB::table('ranklists')->select('contest_id')->distinct()->get();
        $checked_contest = array();

        foreach ($all_contests_id as $id) {
            $temp = strval($id->contest_id);


            if(isset($_POST[$temp])) {

                array_push($checked_contest,$id);
            }
        }

        return view("admin/exp_merge", compact('checked_contest'));

    }


}
