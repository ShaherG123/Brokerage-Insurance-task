<?php

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

Route::post("/register", 'App\Http\Controllers\API\AuthController@register');
Route::post("/login", 'App\Http\Controllers\API\AuthController@login');
Route::get('/auth-validation', function () {
    $array = [
        'meta' => [],
        'items' => [],
        'status' => false,
        'message' => 'You are not authenticated, Please login',
        'errors' => [],
    ];
    return response($array, 401);
})->name('unauthenticated');

Route::group([
    'middleware' => ['auth:sanctum'],
], function () {
    Route::post("/logout", 'App\Http\Controllers\API\AuthController@logout');
    Route::post("/setnewpassword", 'App\Http\Controllers\API\AuthController@setnewpassword');
    Route::post("/updateInfo", 'App\Http\Controllers\API\AuthController@updateInfo');
    //course bookmark
    Route::post("/course/bookmark", 'App\Http\Controllers\API\CoursesController@bookmark');
});

Route::get("/categories", 'App\Http\Controllers\API\CategoriesController@records');
Route::get("/courses/recent", 'App\Http\Controllers\API\CoursesController@recent');

Route::get("/courseContent/records/{course_id}", 'App\Http\Controllers\API\CourseContentController@records');
Route::get("/courseContent/record/{id}", 'App\Http\Controllers\API\CourseContentController@record');
