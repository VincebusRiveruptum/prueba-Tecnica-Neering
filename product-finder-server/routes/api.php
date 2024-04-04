<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth methods
Route::post('/register', [AuthController::class, 'register'])
                ->middleware('guest')
                ->name('register');

Route::post('/login', [AuthController::class, 'login'])
                ->middleware('guest')
                ->name('login');

Route::group(['prefix' => '', 'middleware' => 'auth:sanctum'], function (){
    Route::get('logout', [AuthController::class, 'logout'])
//                    ->middleware('auth')
                    ->name('logout');
});                    

// Product requests
Route::group(['prefix' => 'products', 'middleware' => 'auth:sanctum'], function () {
    Route::post('add', [ProductController::class, 'store']);
    Route::patch('update/{id}', [ProductController::class, 'update']);
    Route::get('indexRanged/{page}/{perPage}', [ProductController::class, 'indexRanged']);
    Route::get('{id}', [ProductController::class, 'getProduct']);
    Route::get('indexRangedFiltered/{page}/{perPage}', [ProductController::class, 'indexRangedFiltered'])->middleware('blockAfterFiveRequests');
    Route::get('get', [ProductController::class, 'show']);
    Route::delete('delete/{id}', [ProductController::class, 'destroy']);
});

// User requests
Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('index', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'getUser']);
    Route::get('indexRanged/{page}/{perPage}/{filter}', [UserController::class, 'indexRanged']);
    Route::post('add', [UserController::class, 'store']);
    Route::patch('update/{id}', [UserController::class, 'update']);
    Route::delete('delete/{id}', [UserController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
