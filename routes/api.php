<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');
    Route::post('upload-foto', 'PostController@uploadFoto');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('categorias', 'PostController@postCategori');
        Route::post('delete-categorias', 'PostController@deleteCat');
        Route::post('add-categorias', 'PostController@addCat');
        Route::post('create', 'PostController@createPost');
        Route::post('get-posts-by-id', 'PostController@getPostsById');
        Route::get('get-posts', 'PostController@getPostsAll');
        Route::post('delete', 'PostController@deletePost');
        Route::post('buscar-post', 'PostController@getPostByText');
        Route::post('post', 'PostController@getPostBySlug');
        Route::get('get-users', 'UsuariosController@getUsersAll');
        Route::post('get-users-by-name', 'UsuariosController@getUsersByName');
        Route::post('delete-user', 'UsuariosController@deleteUser');
        Route::post('save-coment', 'ComentarioController@comentar');
        Route::post('get-coment-by-post', 'ComentarioController@getComentarioByPost');
        Route::post('get-num-comentarios', 'ComentarioController@numComentarios');
    });
});
