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

