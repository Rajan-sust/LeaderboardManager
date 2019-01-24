<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin : Add Contest
Route::get('/home/add/contest','AddContestController@show');
Route::post('/home/add/contest','AddContestController@systemCall');

//Admin : Set Point
Route::get('/home/set/point/contests','SetPointController@show');
Route::get('/home/set/point/{id}','SetPointController@setPoint');
Route::post('/home/set/point/submit','SetPointController@receivePoint');


//Admin : permit admin
Route::get('/home/permit/admin','PermitAdminController@show');
Route::post('/home/permit/admin/confirm','PermitAdminController@makeAdmin');

//Admin : experiment merge
Route::get('/home/merge/experiment','MergeController@show');
Route::post('/home/merge/experiment','MergeController@receive');

//Admin : publish Rank
Route::get('/home/merge/publish','PublishController@show');
Route::post('/home/merge/publish','PublishController@publish');


//User : Merged Rank
Route::get('/home/merged/rank','UserMergeController@show');

//User : Problem Archive
Route::get('/home/archive/problem','ProblemArchController@show');
