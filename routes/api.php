<?php

use App\Http\Controllers\Api\HelloController;
use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/hello', [HelloController::class, 'index']);


Route::get('/test2', function () {
    return 'API working';
});

Route::middleware('auth:api')->group(function () {

    Route::post('/articles', [ArticleController::class, 'store']);
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::get('/users', [AuthController::class,'index']);
    Route::get('/users/{id}', [AuthController::class,'show']);
    Route::put('/user', [AuthController::class, 'update']);

});

    
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);