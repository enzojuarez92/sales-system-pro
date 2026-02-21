<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Ruta Login
Route::post('/login', [AuthController::class, 'login']);


//Ruta Protegidas por Authentication
Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('can:manage taxes')->group(function () {
        Route::post('/taxes', [TaxController::class, 'store']);
        Route::put('/taxes/{tax}', [TaxController::class, 'update']);
        Route::delete('/taxes/{tax}', [TaxController::class, 'destroy']);
    });

    Route::middleware('can:manage categories')->group(function(){
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    });

    Route::get('/taxes', [TaxController::class, 'index']);
    Route::get('/taxes/{tax}', [TaxController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
});
