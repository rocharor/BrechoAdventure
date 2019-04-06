<?php
// Route::get('/cache/atualizar',['as'=>'cache','uses'=>'Admin\AdminController@updateCacheProducts']);
// Route::post('/cache/getFilter',['as'=>'getFilter','uses'=>'Site\ProdutoController@getCacheFilter']);

/***************
| Rotas do site
***************/
### Links ###
Route::get('/',['as'=>'home','uses'=>'Site\HomeController@index']);

Route::get('/produto/{pg?}',['as'=> 'product','uses'=>'Site\ProductController@index']);
Route::get('/produto/visualizar-produto/{param}',['as'=> 'product-view', 'middleware' => ['CheckStatusProduct'], 'uses'=>'Site\ProductController@show']);

Route::get('/contato',['as'=>'contact','uses'=>'Site\ContactController@index']);

### Ações ###
Route::post('/produto/busca-filtro',['as'=>'busca-filtro','uses'=>'Site\ProductController@getFiltro']);

Route::post('/contact/store',['as'=>'contatoPost','uses'=>'Site\ContactController@store']);

/**************************
| Rotas da area Minha Conta
**************************/
Route::group(['prefix' => 'minha-conta', 'as' => 'minha-conta.', 'middleware' => ['auth'] ], function () {
    ### Links ###
    Route::get('/favorito/{pg?}',['as'=>'meus-favorito','uses'=>'Site\FavoriteController@index']);

    Route::get('/perfil',['as'=>'profile','uses'=>'Site\ProfileController@index']);

    Route::get('/produto/create',['as'=>'product-create','uses'=>'Site\MyProductController@create']);
    Route::get('/produto/editar-produto/{param}',['as'=>'product-edit', 'middleware' => ['CheckAuthProduct'], 'uses'=>'Site\MyProductController@edit']);
    Route::get('/produto/{pg?}',['as'=>'my-product','uses'=>'Site\MyProductController@index']);

    Route::get('/mensagem',['as'=>'mensagem','uses'=>'Site\MessageController@index']);

    ### Ações ###
    Route::post('/favorito/storeFavorito',['as'=>'storeFavorito','uses'=>'Site\FavoriteController@store']);
    Route::get('/favorito/delete/{id}',['as'=>'delete-favorito','middleware' => ['CheckAuthFavorite'], 'uses'=>'Site\FavoriteController@delete']);

    Route::post('/perfil/update',['as'=>'update-profile','uses'=>'Site\ProfileController@update']);
    Route::post('/perfil/update-Foto',['as'=>'update-foto','uses'=>'Site\ProfileController@updatePhoto']);
    Route::post('/perfil/update-password',['as'=>'update-password','uses'=>'Site\ProfileController@updatePassword']);

    Route::get('/produto/inativar/{id}',['as'=>'inativar-produto','uses'=>'Site\MyProductController@inactivate']);
    Route::get('/produto/delete/{id}',['as'=>'delete-produto','uses'=>'Site\MyProductController@delete']);
    Route::post('/produto/delete-foto',['as'=>'delete-foto','uses'=>'Site\MyProductController@deletePhoto']);
    Route::post('/produto/update',['as'=>'product-update','uses'=>'Site\MyProductController@update']);
    Route::post('/produto/store',['as'=>'product-store','uses'=>'Site\MyProductController@store']);

    Route::post('/mensagem/create',['as'=>'create','uses'=>'Site\MessageController@create']);
    Route::post('/mensagem/store',['as'=>'storeMensagem','uses'=>'Site\MessageController@store']);
    Route::post('/mensagem/update',['as'=>'update-mensagem','uses'=>'Site\MessageController@update']);
    Route::post('/mensagem/delete',['as'=>'delete-mensagem','uses'=>'Site\MessageController@delete']);
    Route::post('/mensagem/buscaNotificacao',['as'=>'buscaNotificacao','uses'=>'Site\MessageController@buscaNotificacao']);
    Route::post('/mensagem/updateNotificacao',['as'=>'updateNotificacao','uses'=>'Site\MessageController@updateNotificacao']);
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
        Route::get('/roles/list',['as'=>'roles-list', 'uses'=>'Admin\AclController@listRoles']);
        Route::get('/permissions/list',['as'=>'permissions-list', 'uses'=>'Admin\AclController@listPermissions']);
        Route::get('/role-permissions/list',['as'=>'role-permissions-list', 'uses'=>'Admin\AclController@listRolePermissions']);
        ### Ações ###
        Route::post('/roles/store',['as'=>'store-role','uses'=>'Admin\AclController@storeRole']);
        Route::get('/roles/delete/{id}',['as'=>'delete-role','uses'=>'Admin\AclController@deleteRole']);
        Route::post('/permissions/store',['as'=>'store-permission','uses'=>'Admin\AclController@storePermission']);
        Route::get('/permissions/delete/{id}',['as'=>'delete-permission','uses'=>'Admin\AclController@deletePermission']);
        Route::post('/role-permissions/update',['as'=>'update-role-permission','uses'=>'Admin\AclController@updateRolePermission']);
        Route::post('/role-user/update',['as'=>'update-role-user','uses'=>'Admin\AclController@updateRoleUser']);
    });
});

/************************
| Rotas de Autentication
*************************/
Auth::routes();
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@logout']);
Route::get('/cadastre-se',['as'=>'cadastre-se','uses'=>'Auth\RegisterController@showRegistrationForm']);

Auth::routes();
