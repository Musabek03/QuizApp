<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/signUp', [UserController::class, 'register']);
Route::post('/signIn', [UserController::class, 'signIn']);
Route::get('/users/getMe', [UserController::class, 'show'])->middleware(['auth:sanctum']);

Route::prefix('/categories')
    ->group(function (){

        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [CategoryController::class, 'delete']);
        Route::get('/show/{id}', [CategoryController::class, "show"]);
    });

