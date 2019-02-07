<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Login
 */

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
    /**
     * Usuarios
     */
    Route::get('usuarios','UsuarioController@index');
    // get specific 
    Route::get('usuarios/{id}','UsuarioController@show');
    // create
    Route::post('usuarios','UsuarioController@store');
    // update existing
    Route::put('usuarios','UsuarioController@store');
    // delete 
    Route::delete('usuarios/{id}','UsuarioController@destroy');

    Route::post('experiencias','ExperienciasController@store');
});

