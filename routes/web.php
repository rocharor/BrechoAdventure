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
Route::post('/cache/getFilter',['as'=>'getFilter','uses'=>'Site\ProdutoController@getCacheFilter']);

// Rotas do site
// Menus
Route::get('/',['as'=>'home','uses'=>'Site\ProdutoController@index']);
// Route::get('/produto/todosProdutos/{pg?}',['as'=>'todosProdutos','uses'=>'Site\ProdutoController@todosProdutos']);
Route::get('/produtos/{pg?}',['as'=>'produtos','uses'=>'Site\ProdutoController@produtos']);
Route::get('/produtos/visualizar-produto/{produto_id}',['as'=>'visualizarProduto', 'middleware' => ['CheckStatusProduct'], 'uses'=>'Site\ProdutoController@show']);
Route::get('/contato',['as'=>'contato','uses'=>'Site\ContatoController@index']);

// Açoes
Route::post('/contato/store',['as'=>'contatoPost','uses'=>'Site\ContatoController@store']);
// Route::post('/produto/descricao-produto',['as'=>'descProduto','uses'=>'Site\ProdutoController@show']);

// Rotas da area Minha Conta
Route::group(['prefix' => 'minha-conta', 'as' => 'minha-conta.', 'middleware' => ['auth'] ], function () {
    // Menus
    Route::get('/perfil',['as'=>'perfil','uses'=>'Site\PerfilController@index']);
    Route::get('/favorito',['as'=>'meus-favorito','uses'=>'Site\FavoritoController@index']);
    Route::get('/mensagem',['as'=>'mensagem','uses'=>'Site\MensagemController@index']);
    Route::get('/produto/create',['as'=>'create-produto','uses'=>'Site\ProdutoController@create']);
    Route::get('/produto/editar-produto/{id}',['as'=>'editar-produto', 'middleware' => ['CheckAuthProduct'], 'uses'=>'Site\ProdutoController@edit']);
    Route::get('/produto/{pg?}',['as'=>'meus-produto','uses'=>'Site\ProdutoController@meusProdutos']);

    // Ações
    Route::post('/favorito/storeFavorito',['as'=>'storeFavorito','uses'=>'Site\FavoritoController@store']);

    Route::post('/perfil/update',['as'=>'update-perfil','uses'=>'Site\PerfilController@update']);
    Route::post('/perfil/update-Foto',['as'=>'update-foto','uses'=>'Site\PerfilController@updateFoto']);
    // Route::post('/perfil/busca-cep',['as'=>'busca-cep','uses'=>'Site\PerfilController@buscaCep']);

    Route::post('/produto/store',['as'=>'store-produto','uses'=>'Site\ProdutoController@store']);
    Route::post('/produto/destroy/{id}',['as'=>'update-produto','uses'=>'Site\ProdutoController@destroy']);
    Route::post('/produto/update/{id}',['as'=>'update-produto','uses'=>'Site\ProdutoController@update']);
    Route::post('/produto/delete-foto',['as'=>'delete-foto','uses'=>'Site\ProdutoController@deletePhoto']);

    Route::post('/mensagem/create',['as'=>'create','uses'=>'Site\MensagemController@create']);
    Route::post('/mensagem/store',['as'=>'storeMensagem','uses'=>'Site\MensagemController@store']);
    Route::post('/mensagem/update',['as'=>'updateMensagem','uses'=>'Site\MensagemController@update']);
    Route::post('/mensagem/buscaNotificacao',['as'=>'buscaNotificacao','uses'=>'Site\MensagemController@buscaNotificacao']);
    Route::post('/mensagem/updateNotificacao',['as'=>'updateNotificacao','uses'=>'Site\MensagemController@updateNotificacao']);
});

// Rotas da area Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','can:admin'] ], function () {
    //Links
    Route::get('/home',['as'=>'home','uses'=>'Admin\AdminController@index']);
});

// Autentication
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
