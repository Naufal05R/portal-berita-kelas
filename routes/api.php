<?php

// use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route login
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
//route register
Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
//route logout
Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');
//route update-password
Route::post('update-password', [\App\Http\Controllers\API\AuthController::class, 'updatePassword'])->middleware('auth:sanctum');

//get all user
Route::get('getAllUser', [\App\Http\Controllers\API\UserController::class, 'getAllUser'])->middleware('auth:sanctum');
Route::get('getUserById/{id}', [\App\Http\Controllers\API\UserController::class, 'getUserById'])->middleware('auth:sanctum');

//category
Route::get('category', [\App\Http\Controllers\API\CategoryController::class, 'index']);
Route::get('category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'show']);
Route::post('category', [\App\Http\Controllers\API\CategoryController::class, 'create'])->middleware('auth:sanctum');
Route::delete('category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'destroy'])->middleware('auth:sanctum');

//sliders
Route::get('slider', [\App\Http\Controllers\API\SliderController::class, 'index']);
Route::get('slider/{id}', [\App\Http\Controllers\API\SliderController::class, 'show']);
Route::post('slider', [\App\Http\Controllers\API\SliderController::class, 'create'])->middleware('auth:sanctum');
Route::delete('slider/{id}', [\App\Http\Controllers\API\SliderController::class, 'destroy'])->middleware('auth:sanctum');

//news
Route::get('news', [\App\Http\Controllers\API\NewsController::class, 'index']);
Route::get('news/{id}', [\App\Http\Controllers\API\NewsController::class, 'show']);
Route::post('news', [\App\Http\Controllers\API\NewsController::class, 'create'])->middleware('auth:sanctum');
Route::delete('news/{id}', [\App\Http\Controllers\API\NewsController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('news/{id}', [\App\Http\Controllers\API\NewsController::class, 'update'])->middleware('auth:sanctum');



