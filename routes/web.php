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

// Menus
Route::get('/',['as'=>'home','uses'=>'Site\Home@indexAction']);
Route::get('/produto',['as'=>'produto','uses'=>'Site\Produto@indexAction']);
Route::get('/contato',['as'=>'contato','uses'=>'Site\Contato@indexAction']);

Route::get('/minha-conta/perfil',['as'=>'mcperfil','uses'=>'MinhaConta\Perfil@indexAction']);
Route::get('/minha-conta/produto',['as'=>'mcproduto','uses'=>'MinhaConta\Produto@indexAction']);
Route::get('/minha-conta/favorito',['as'=>'mcfavorito','uses'=>'MinhaConta\Favorito@indexAction']);

// Açoes
Route::post('/contato',['as'=>'contatoPost','uses'=>'Site\Contato@salvaContatoAction']);

// AJAX
Route::post('/Produto/getDescricaoProduto',['as'=>'descProduto','uses'=>'Site\Produto@getDescricaoProdutoAction']);

// Autentication
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
//Route::get('/home', 'HomeController@index');



// Route::post('/Produto/getDescricaoProduto', function () {
//     die('akiiii');
//     return view('welcome');
// });
