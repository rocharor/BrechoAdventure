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
Route::get('/',['as'=>'home','uses'=>'Site\HomeController@index']);
Route::get('/produto',['as'=>'produto','uses'=>'Site\ProdutoController@index']);
Route::get('/contato',['as'=>'contato','uses'=>'Site\ContatoController@index']);

Route::get('/minha-conta/perfil',['as'=>'mcperfil','uses'=>'MinhaConta\PerfilController@index']);
Route::get('/minha-conta/produto',['as'=>'mcproduto','uses'=>'MinhaConta\Produto@indexAction']);
Route::get('/minha-conta/favorito',['as'=>'mcfavorito','uses'=>'MinhaConta\Favorito@indexAction']);

// Açoes
Route::post('/contato',['as'=>'contatoPost','uses'=>'Site\ContatoController@store']);


// AJAX
Route::post('/Produto/getDescricaoProduto',['as'=>'descProduto','uses'=>'Site\ProdutoController@getDescricaoProduto']);
Route::post('/minha-conta/perfil/updatePerfil',['as'=>'updatePerfil','uses'=>'MinhaConta\PerfilController@update']);
Route::post('/minha-conta/perfil/updateFoto',['as'=>'updateFoto','uses'=>'MinhaConta\Perfil@updateFoto']);

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
