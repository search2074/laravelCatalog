<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Маршруты аутентификации...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::get('/products/edit/{id}', 'ProductController@edit');
Route::post('/products/update/{id}', 'ProductController@update');
Route::get('/products/delete/{id}', 'ProductController@delete');
Route::post('/products/store', 'ProductController@store');
Route::get('/products/show/{product}', 'ProductController@show');
Route::post('/products/generatelist', 'ProductController@generateList');

Route::get('/lists/products', 'ListController@products');
Route::post('/lists/send', 'ListController@send');