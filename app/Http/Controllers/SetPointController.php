<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetPointController extends Controller {



    public function show() {


        if(Auth::check() == false){
            return redirect('/');
        }

        if(Auth::user()->admin == true) {
            return view('admin/all_contests_for_setting_point');
        }

        return abort('401');


    }

    public function setPoint($id) {

        if(Auth::check() == false) {
            return redirect('/');
        }

        if(Auth::user()->admin == true) {

            if(DB::table('problems')->where('contest_id',$id)->exists()) {
                return view('admin/single_contest_for_setting_point')->with('id',$id);
            }else{
                return abort('404');
            }

        }else{
            return abort('401');
        }


    }

    public function receivePoint() {

        $points = $_POST['weight'];

        $contest_id = $_POST['id'];


        $contestants = DB::table('ranklists')->select('username','solved_mask')->where('contest_id',$contest_id)->distinct()->get();




        foreach ($contestants as $contestant) {

            $problemlist = $contestant->solved_mask;
            $obtain_points = 0;

            for ($idx = 0;$idx < strlen($problemlist); $idx++) {

                if($problemlist[$idx]=='1'){
                    $obtain_points += $points[$idx];
                }
            }



            DB::table('ranklists')
                ->where('contest_id',$contest_id)
                ->where('username',$contestant->username)
                ->update(['score' => $obtain_points]);


        }

        $url = '/home/set/point/'.$contest_id;


        return redirect($url)->with('message','success');





    }

}
