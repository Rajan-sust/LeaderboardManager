<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestArchController extends Controller {

    public function show() {
        if(Auth::check()){
            return view('user/contest_archive');
        }
        return redirect('/');
    }
}
