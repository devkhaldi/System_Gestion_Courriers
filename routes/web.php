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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','UiController@index') ;
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'CourrierController@index');

Route::get('courrier/nonvalide', 'CourrierController@nonvalide');
Route::get('courrier/valide', 'CourrierController@valide');
Route::get('courrier/nonvue', 'CourrierController@nonvue');
Route::get('courrier/vue', 'CourrierController@vue');
Route::get('/courrier/create', 'CourrierController@create');
Route::post('/courrier/store', 'CourrierController@store');
Route::get('/courrier/{id}', 'CourrierController@show');
Route::get('courrier/valider/{id}', 'CourrierController@valider');
Route::post('courrier/savevalidation/{id}', 'CourrierController@savevalidation');
Route::get('piecejointe/{id}', 'PiecejointeController@index');
Route::post('courrier/search', 'CourrierController@search');
Route::get('courrier/status/{id}', 'CourrierController@status');
Route::get('courrier/statuscourrier/{id}', 'CourrierController@statuscourrier');
// services 
Route::get('utilisateurs', 'ServiceController@index');

// Create users
Route::get('user/create', 'UserController@create');
Route::post('user/store', 'UserController@store');
