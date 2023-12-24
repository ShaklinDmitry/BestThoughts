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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/bestthought', function (Request $request) {
    return $request->user();
});


Route::post('/user', [\App\Modules\User\Infrastructure\Controllers\UserController::class, 'register']);

Route::post('/login', [\App\Modules\User\Infrastructure\Controllers\UserController::class, 'login']);
