<?php
// Route::get('/cache/atualizar',['as'=>'cache','uses'=>'Admin\AdminController@updateCacheProducts']);
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
    Route::post('/perfil/update-password',['as'=>'update-password','uses'=>'Site\PerfilController@updatePassword']);
    Route::post('/produto/store',['as'=>'store-produto','uses'=>'Site\ProdutoController@store']);
    Route::post('/produto/delete/{id}',['as'=>'delete-produto','uses'=>'Site\ProdutoController@delete']);
    Route::post('/produto/update',['as'=>'update-produto','uses'=>'Site\ProdutoController@update']);
    Route::post('/produto/delete-foto',['as'=>'delete-foto','uses'=>'Site\ProdutoController@deletePhoto']);
    Route::post('/mensagem/create',['as'=>'create','uses'=>'Site\MensagemController@create']);
    Route::post('/mensagem/store',['as'=>'storeMensagem','uses'=>'Site\MensagemController@store']);
    Route::post('/mensagem/update',['as'=>'update-mensagem','uses'=>'Site\MensagemController@update']);
    Route::post('/mensagem/delete',['as'=>'delete-mensagem','uses'=>'Site\MensagemController@delete']);
    Route::post('/mensagem/buscaNotificacao',['as'=>'buscaNotificacao','uses'=>'Site\MensagemController@buscaNotificacao']);
    Route::post('/mensagem/updateNotificacao',['as'=>'updateNotificacao','uses'=>'Site\MensagemController@updateNotificacao']);
});

/********************
| Rotas da área Admin
*********************/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','can:pg-admin'] ], function () {
    ### Links ###
    Route::get('',['as'=>'home','uses'=>'Admin\DashboardController@index']);

    /********************
    | Rotas Pendentes
    *********************/
    Route::group(['prefix' => 'pendente', 'as' => 'pendente.', 'middleware' => ['can:admin-pendente'] ], function () {
        ### Links ###
        Route::get('/produto/list',['as'=>'product-list','uses'=>'Admin\ProductController@index']);
        Route::get('/produto/view/{id}',['as'=>'product-view','uses'=>'Admin\ProductController@show']);
        Route::get('/contato/list',['as'=>'contact-list','uses'=>'Admin\ContactController@index']);
        Route::get('/contato/view/{id}',['as'=>'contact-view','uses'=>'Admin\ContactController@show']);
        ### Ações ###
        Route::post('/produto/alter-status',['as'=>'product-status','uses'=>'Admin\ProductController@update']);
        Route::post('/contato/resposta',['as'=>'contact-resposta','uses'=>'Admin\ContactController@update']);
    });
    /********************
    | Rotas Usuário
    *********************/
    Route::group(['prefix' => 'usuario', 'as' => 'usuario.', 'middleware' => ['can:admin-usuario'] ], function () {
        ### Links ###
        Route::get('/user',['as'=>'user', 'uses'=>'Admin\UserController@index']);
        Route::get('/user/edit/{id}',['as'=>'user-edit', 'uses'=>'Admin\UserController@edit']);
        ### Ações ###
        Route::get('/user/delete/{id}',['as'=>'user-delete','uses'=>'Admin\UserController@delete']);
        Route::post('/user/update',['as'=>'user-update','uses'=>'Admin\UserController@update']);
    });
    /********************
    | Rotas ACL
    *********************/
    Route::group(['prefix' => 'acl', 'as' => 'acl.', 'middleware' => ['can:admin-acl'] ], function () {
        ### Links ###
        Route::get('/acl/roles/list',['as'=>'roles-list', 'uses'=>'Admin\AclController@listRoles']);
        Route::get('/acl/permissions/list',['as'=>'permissions-list', 'uses'=>'Admin\AclController@listPermissions']);
        Route::get('/acl/role-permissions/list',['as'=>'role-permissions-list', 'uses'=>'Admin\AclController@listRolePermissions']);
        ### Ações ###
        Route::post('/acl/roles/store',['as'=>'store-role','uses'=>'Admin\AclController@storeRole']);
        Route::get('/acl/roles/delete/{id}',['as'=>'delete-role','uses'=>'Admin\AclController@deleteRole']);
        Route::post('/acl/permissions/store',['as'=>'store-permission','uses'=>'Admin\AclController@storePermission']);
        Route::get('/acl/permissions/delete/{id}',['as'=>'delete-permission','uses'=>'Admin\AclController@deletePermission']);
        Route::post('/acl/role-permissions/update',['as'=>'update-role-permission','uses'=>'Admin\AclController@updateRolePermission']);
        Route::post('/acl/role-user/update',['as'=>'update-role-user','uses'=>'Admin\AclController@updateRoleUser']);
    });
});

/************************
| Rotas de Autentication
*************************/
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);
