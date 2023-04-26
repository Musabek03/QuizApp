<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/random-code', TestController::class);

Route::middleware(['guest'])->group(function () {
    Route::post('/singUp', [UserController::class, 'register']);
    Route::post('/singIn', [UserController::class, 'singIn']);
});


Route::middleware(['auth:sanctum', 'ability:user,admin'])->group(function () {
    Route::prefix('/categories')
        ->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{id}', [CategoryController::class, 'show']);
        });

    Route::prefix('/collections')
        ->group(function () {
            Route::get('/', [CollectionController::class, 'index']);
            Route::get('/{id}', [CollectionController::class, 'show']);
        });
});
Route::middleware(['auth:sanctum', 'abilities:admin'])->group(function () {
    Route::get('/getme', [UserController::class, 'show']);
    Route::prefix('/categories')
        ->group(function () {
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });
    Route::prefix('/collections')
        ->group(function () {
            Route::post('/', [CollectionController::class, 'store']);
            Route::put('/{id}', [CollectionController::class, 'update']);
            Route::delete('/{id}', [CollectionController::class, 'destroy']);
        });
});

