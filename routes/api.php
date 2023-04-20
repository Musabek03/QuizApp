<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/singUp', [UserController::class, 'register']);
Route::post('/singIn', [UserController::class, 'singIn']);
Route::get('/users/getme', [UserController::class, 'show'])->middleware(['auth:sanctum','abilities:admin']);

Route::prefix('/categories')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
