<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// jwt用に追加
use App\Http\Controllers\API\JWTAuthController;

// post用に追加
use App\Http\Controllers\API\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// jwt用に追加
Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
});
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('post', [PostController::class, 'post']);
});
