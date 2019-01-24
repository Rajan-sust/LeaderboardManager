<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMergeController extends Controller {

    public function show() {
        if(Auth::check() == false){
            return redirect('/');
        }

        return view('user/user_merged_rank');

    }
}
