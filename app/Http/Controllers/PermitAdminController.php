<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermitAdminController extends Controller {

    public function show() {

        if(Auth::check() == false) {
            return redirect('/');
        }
        if(Auth::user()->admin == true){
            return view('admin/permit_admin');
        }else{
            return abort('401');
        }
    }

    public function makeAdmin() {
        $mail = $_POST['mail'];
        DB::table('users')->where('email',$mail)->update(['admin' => true]);
        return redirect('/home/permit/admin')->with('message','adminnow');
    }
}
