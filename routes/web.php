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
    Route::get('/contato',['as'=>'contato','uses'=>'Site\ContatoController@index']);
    Route::get('/produto',['as'=>'produto','uses'=>'Site\ProdutoController@index']);
    Route::get('/produto/todosProdutos/{pg}',['as'=>'todosProduto','uses'=>'Site\ProdutoController@todosProdutosIndex']);

// Açoes
    Route::post('/contato/store',['as'=>'contatoPost','uses'=>'Site\ContatoController@store']);
    Route::post('/produto/descricao-produto',['as'=>'descProduto','uses'=>'Site\ProdutoController@show']);

// Rotas da area Minha Conta
Route::group(['prefix' => 'minha-conta', 'as' => 'minha-conta.', 'middleware' => 'auth'], function () {
    // Menus
    Route::get('/perfil',['as'=>'mcperfil','uses'=>'Site\PerfilController@index']);
    Route::get('/favorito',['as'=>'mcfavorito','uses'=>'Site\FavoritoController@index']);
    Route::get('/produto',['as'=>'mcproduto','uses'=>'Site\ProdutoController@indexMC']);
    Route::get('/mensagem',['as'=>'mcmensagem','uses'=>'Site\MensagemController@index']);
    Route::get('/produto/cadastro-produto',['as'=>'cadastro-produto','uses'=>'Site\ProdutoController@cadastroIndex']);
    Route::get('/produto/editar-produto/{id}',['as'=>'editar-produto','uses'=>'Site\ProdutoController@edit']);

    // Ações
    Route::post('/favorito/setFavorito',['as'=>'setFavorito','uses'=>'Site\FavoritoController@create']);
    Route::post('/perfil/update',['as'=>'updatePerfil','uses'=>'Site\PerfilController@update']);
    Route::post('/perfil/updateFoto',['as'=>'updateFoto','uses'=>'Site\PerfilController@updateFoto']);
    Route::post('/produto/create',['as'=>'create-produto','uses'=>'Site\ProdutoController@create']);
    Route::post('/produto/destroy/{id}',['as'=>'update-produto','uses'=>'Site\ProdutoController@destroy']);
    Route::post('/produto/update/{id}',['as'=>'update-produto','uses'=>'Site\ProdutoController@update']);
    Route::post('/mensagem/create',['as'=>'create','uses'=>'Site\MensagemController@create']);
    Route::post('/mensagem/store',['as'=>'storeMensagem','uses'=>'Site\MensagemController@store']);
    Route::post('/mensagem/update',['as'=>'updateMensagem','uses'=>'Site\MensagemController@update']);
    Route::post('/mensagem/buscaNotificacao',['as'=>'buscaNotificacao','uses'=>'Site\MensagemController@buscaNotificacao']);
    Route::post('/mensagem/update2',['as'=>'update2','uses'=>'Site\MensagemController@update2']);
});


// Autentication
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
