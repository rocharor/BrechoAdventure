<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['as'=>'home','uses'=>'Site\Home@indexAction']);
Route::get('/produto',['as'=>'produto','uses'=>'Site\Produto@indexAction']);
Route::get('/contato',['as'=>'contato','uses'=>'Site\Contato@indexAction']);

/*
Route::get('/', function () {
    return view('welcome');
});
*/
