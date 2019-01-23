<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublishController extends Controller {

    public function show() {
        if(Auth::check() == false) {
            return redirect('/');
        }
        if(Auth::user()->admin == true) {
            return view('admin/merge_publish');
        }else{
            return abort('401');
        }
    }

    public function publish() {

        DB::table('publishcontests')->truncate();

        $all_contests_id = DB::table('ranklists')->select('contest_id')->distinct()->get();


        foreach ($all_contests_id as $id) {
            $temp = strval($id->contest_id);


            if(isset($_POST[$temp])) {
                DB::table('publishcontests')->insert(['contest_id' => $id->contest_id]);


            }
        }

        return redirect()->back()->with('message','success');



    }

}
