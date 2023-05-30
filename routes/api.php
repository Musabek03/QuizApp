<?php

use App\Http\Controllers\AllowedController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/random-code', TestController::class);

Route::middleware(['guest'])->group(function () {
    Route::post('/signUp', [UserController::class, 'register']);
    Route::post('/signIn', [UserController::class, 'signIn']);
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
            Route::delete('/{id}', [CategoryController::class, 'delete
            ']);
        });
    Route::prefix('/collections')
        ->group(function () {
            Route::post('/', [CollectionController::class, 'store']);
            Route::put('/{id}', [CollectionController::class, 'update']);
            Route::delete('/{id}', [CollectionController::class, 'destroy']);
        });
});
    Route::middleware(['auth:sanctum', 'ability:user,admin'])->group(function (){
        Route::post('SendCode', [EmailController::class, "SendCode"]);
        Route::post('VerifyCode', [EmailController::class, "VerifyCode"]);
    });

    Route::prefix('/question')
        ->group(function ()
    {
        Route::get('/Index', [QuestionController::class, "index"]);
        Route::get('/Show/{id}', [QuestionController::class, "show"]);
    });

    Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/question')
        ->group(function()
    {
        Route::post('/storeResult', [QuestionController::class, "store"]);
        Route::post('/update/{id}', [QuestionController::class, "update"]);
        Route::delete('/Destroy/{id}', [QuestionController::class, "destroy"]);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/answer')
    ->group(function () {
        Route::post('/Store', [AnswerController::class, "store"]);
        Route::delete('/Destroy/{id}', [AnswerController::class, "destroy"]);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/allowed')
    ->group(function () {
        Route::post('/Store', [AllowedController::class, "store"]);
        Route::delete('/Destroy/{id}', [AllowedController::class, "destroy"]);
    });

    Route::prefix('/result')
        ->group(function ()
    {
        Route::get('/index',[ResultController::class,"index"]);
        Route::get('/statistics', [ResultController::class, "statistics"]);
    });

