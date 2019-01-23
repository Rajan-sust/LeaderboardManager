<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddContestController extends Controller {

    public function show() {

        If(Auth::check() == false){
            return redirect('/');
        }

        if(Auth::user()->admin == true){
            return view('admin/addcontest');

        }

        return abort(401);
    }

    public function systemCall() {

        $url = $_POST['url'];
        $url = str_replace(' ','',$url);

        if(DB::table('contesturls')->where('url',$url)->exists()) {
            return redirect()->back()->with('message','url exists');
        }



        $command = "python3 /home/rajan/SUSTIpc/pythonscript/main.py ".$url;
        exec($command,$output,$return);

        if($return == 0) {

            DB::table('contesturls')->insert(['url' => $url]);
            return redirect()->back()->with('message','contest fetched');
        }

        else{
            return redirect()->back()->with('message','exception occured');

        }
    }

}
