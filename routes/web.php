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

// Rotas da area Minha Conta
    // Menus
    Route::get('/',['as'=>'home','uses'=>'Site\HomeController@index']);
    Route::get('/produto',['as'=>'produto','uses'=>'Site\ProdutoController@index']);
    Route::get('/contato',['as'=>'contato','uses'=>'Site\ContatoController@index']);

    // Açoes
    Route::post('/contato',['as'=>'contatoPost','uses'=>'Site\ContatoController@store']);
    Route::post('/Produto/getDescricaoProduto',['as'=>'descProduto','uses'=>'Site\ProdutoController@getDescricaoProduto']);

// Rotas da area Minha Conta
Route::group(['prefix' => 'minha-conta', 'as' => 'minha-conta.', 'middleware' => 'auth'], function () {
    // Menus
    Route::get('/perfil',['as'=>'mcperfil','uses'=>'MinhaConta\PerfilController@index']);
    Route::get('/produto',['as'=>'mcproduto','uses'=>'MinhaConta\Produto@indexAction']);
    Route::get('/favorito',['as'=>'mcfavorito','uses'=>'MinhaConta\Favorito@indexAction']);

    // Ações
    Route::post('/perfil/updatePerfil',['as'=>'updatePerfil','uses'=>'MinhaConta\PerfilController@update']);
    Route::post('/perfil/updateFoto',['as'=>'updateFoto','uses'=>'MinhaConta\PerfilController@updateFoto']);
});


// Autentication
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
