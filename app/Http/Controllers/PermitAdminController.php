<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
