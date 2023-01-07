<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rutas API
|--------------------------------------------------------------------------
|
| Registro de rutas API. RouteServiceProvider carga estas rutas ro de
| un grupo al que se le asigna el grupo de middleware "api".
*/


    /**
     * Rutas inicio, registro y cierre de sesion.
     */

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    });


    /**
     * Rutas Permisos.
     */
    Route::group([
        'middleware' => 'api',
        'prefix' => 'permission',
        'middleware' => 'auth:api'],  function () {
            Route::post('get-permissions','PermissionController@getPermissions');
        });

    /**
     * Rutas Producto.
     */
    Route::group([
        'middleware' => 'api',
        'prefix' => 'product',
        'middleware' => 'auth:api'],  function () {
            Route::post('list','ProductController@index');
            Route::post('create','ProductController@create');
            Route::post('update','ProductController@update');
            Route::post('show','ProductController@show');
            Route::post('update/state','ProductController@state');
            Route::get('detail/category','ProductController@getCategories');
            Route::post('unique/reference','ProductController@uniqueReference');
        });


    /**
     * Rutas Venta.
     */
    Route::group([
        'middleware' => 'api',
        'prefix' => 'sale',
        'middleware' => 'auth:api'],  function () {
            Route::post('list','SaleController@index');
            Route::post('create','SaleController@create');
        });

