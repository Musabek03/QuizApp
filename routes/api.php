<?php

use App\Http\Controllers\AllowedController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\QuestionController;
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
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });
    Route::prefix('/collections')
        ->group(function () {
            Route::post('/', [CollectionController::class, 'store']);
            Route::put('/{id}', [CollectionController::class, 'update']);
            Route::delete('/{id}', [CollectionController::class, 'destroy']);
        });
});

   Route::post('SendCode', [EmailController::class, "SendCode"])->middleware('auth:sanctum');
   Route::post('VerifyCode', [EmailController::class, "VerifyCode"])->middleware('auth:sanctum');

   Route::get('IndexQuestion', [QuestionController::class, "index"])->middleware(['auth:sanctum', 'abilities:admin']);
   Route::get('ShowQuestion/{id}', [QuestionController::class, "show"]);
   Route::post('storeQuestion', [QuestionController::class, "store"]);
   Route::post('updateQuestion/{id}', [QuestionController::class, "update"]);
   Route::delete('DestroyQuestion/{id}', [QuestionController::class, "destroy"]);


   Route::post('StoreAnswer', [AnswerController::class, "store"]);
   Route::delete('DestroyDelete/{id}', [AnswerController::class, "destroy"]);


   Route::post('AllowedStore',[AllowedController::class, "store"] );
   Route::delete('DestroyAllowed/{id}', [AllowedController::class, "destroy"]);

   Route::get('IndexUser',[\App\Http\Controllers\ResultController::class,"index"]);
