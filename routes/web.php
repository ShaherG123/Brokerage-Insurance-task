<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'App\Http\Controllers\Dashboard\AuthController@index')->name('login');
Route::post('/post-login', 'App\Http\Controllers\Dashboard\AuthController@postLogin');

// for all users
Route::group(['middleware' => 'web'], function () {

    Route::middleware('auth')->group(function () {
        Route::middleware('administration')->group(function () {
            Route::get('/logout', 'App\Http\Controllers\Dashboard\\AuthController@logout');
            //Users
            Route::get('/', 'App\Http\Controllers\Dashboard\UserController@index');
            Route::get('/users', 'App\Http\Controllers\Dashboard\UserController@index');
            Route::post('/users/create', 'App\Http\Controllers\Dashboard\UserController@create');
            Route::post('/users/{id}/delete', 'App\Http\Controllers\Dashboard\UserController@delete');
            Route::get('/users/record/{id}', 'App\Http\Controllers\Dashboard\UserController@record');
            Route::post('/users/{id}/update', 'App\Http\Controllers\Dashboard\UserController@update');
            Route::get('/users/records', 'App\Http\Controllers\Dashboard\UserController@records');
        });
        //customers
        Route::get('/customers', 'App\Http\Controllers\Dashboard\CustomerController@index');
        Route::post('/customers/create', 'App\Http\Controllers\Dashboard\CustomerController@create');
        Route::post('/customers/{id}/delete', 'App\Http\Controllers\Dashboard\CustomerController@delete');
        Route::get('/customers/record/{id}', 'App\Http\Controllers\Dashboard\CustomerController@record');
        Route::post('/customers/{id}/update', 'App\Http\Controllers\Dashboard\CustomerController@update');
        Route::get('/customers/records', 'App\Http\Controllers\Dashboard\CustomerController@records');
    });
});
