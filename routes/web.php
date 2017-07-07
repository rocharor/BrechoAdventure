<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| by your application. Just tell Laravel the URIs it should respond
| This file is where you may define all of the routes that are handled
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/cache/atualizar',['as'=>'cache','uses'=>'Admin\AdminController@updateCacheProducts']);
// Route::post('/cache/getFilter',['as'=>'getFilter','uses'=>'Site\ProdutoController@getCacheFilter']);

/***************
| Rotas do site
***************/
### Links ###
Route::get('/',['as'=>'home','uses'=>'Site\ProdutoController@index']);
Route::get('/produtos/{pg?}',['as'=>'produtos','uses'=>'Site\ProdutoController@produtos']);
Route::get('/produtos/visualizar-produto/{param}',['as'=>'visualizar-produto', 'middleware' => ['CheckStatusProduct'], 'uses'=>'Site\ProdutoController@show']);
Route::get('/contato',['as'=>'contato','uses'=>'Site\ContatoController@index']);
### Ações ###
Route::post('/contato/store',['as'=>'contatoPost','uses'=>'Site\ContatoController@store']);
Route::post('/produto/busca-filtro',['as'=>'busca-filtro','uses'=>'Site\ProdutoController@getFiltro']);

/**************************
| Rotas da area Minha Conta
**************************/
Route::group(['prefix' => 'minha-conta', 'as' => 'minha-conta.', 'middleware' => ['auth'] ], function () {
    ### Links ###
    Route::get('/perfil',['as'=>'perfil','uses'=>'Site\PerfilController@index']);
    Route::get('/favorito/{pg?}',['as'=>'meus-favorito','uses'=>'Site\FavoritoController@index']);
    Route::get('/mensagem',['as'=>'mensagem','uses'=>'Site\MensagemController@index']);
    Route::get('/produto/create',['as'=>'create-produto','uses'=>'Site\ProdutoController@create']);
    Route::get('/produto/editar-produto/{param}',['as'=>'editar-produto', 'middleware' => ['CheckAuthProduct'], 'uses'=>'Site\ProdutoController@edit']);
    Route::get('/produto/{pg?}',['as'=>'meus-produto','uses'=>'Site\ProdutoController@meusProdutos']);
    ### Ações ###
    Route::post('/favorito/storeFavorito',['as'=>'storeFavorito','uses'=>'Site\FavoritoController@store']);
    Route::get('/favorito/delete/{id}',['as'=>'delete-favorito','middleware' => ['CheckAuthFavorite'], 'uses'=>'Site\FavoritoController@delete']);
    Route::post('/perfil/update',['as'=>'update-perfil','uses'=>'Site\PerfilController@update']);
    Route::post('/perfil/update-Foto',['as'=>'update-foto','uses'=>'Site\PerfilController@updateFoto']);
    Route::post('/produto/store',['as'=>'store-produto','uses'=>'Site\ProdutoController@store']);
    Route::post('/produto/delete/{id}',['as'=>'delete-produto','uses'=>'Site\ProdutoController@delete']);
    Route::post('/produto/update',['as'=>'update-produto','uses'=>'Site\ProdutoController@update']);
    Route::post('/produto/delete-foto',['as'=>'delete-foto','uses'=>'Site\ProdutoController@deletePhoto']);
    Route::post('/mensagem/create',['as'=>'create','uses'=>'Site\MensagemController@create']);
    Route::post('/mensagem/store',['as'=>'storeMensagem','uses'=>'Site\MensagemController@store']);
    Route::post('/mensagem/update',['as'=>'updateMensagem','uses'=>'Site\MensagemController@update']);
    Route::post('/mensagem/buscaNotificacao',['as'=>'buscaNotificacao','uses'=>'Site\MensagemController@buscaNotificacao']);
    Route::post('/mensagem/updateNotificacao',['as'=>'updateNotificacao','uses'=>'Site\MensagemController@updateNotificacao']);
});

/********************
| Rotas da area Admin
*********************/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','can:admin'] ], function () {
    ### Links ###
    Route::get('/dashboard',['as'=>'home','uses'=>'Admin\DashboardController@index']);
    Route::get('/produto/list',['as'=>'product-list','uses'=>'Admin\ProductController@index']);
    Route::get('/produto/view/{id}',['as'=>'product-view','uses'=>'Admin\ProductController@show']);
    ### Ações ###
    Route::post('/produto/alter-status',['as'=>'product-status','uses'=>'Admin\ProductController@update']);
});

/************************
| Rotas de Autentication
*************************/
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
