<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// Product requests
Route::group(['prefix' => 'products', 'middleware' => 'auth:sanctum'], function () {
    Route::post('add', [ProductController::class, 'store']);
    Route::patch('update/{id}', [ProductController::class, 'update']);
    Route::get('indexRanged', [ProductController::class, 'indexRanged']);
    Route::get('get', [ProductController::class, 'show']);
    Route::delete('delete/{id}', [ProductController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
