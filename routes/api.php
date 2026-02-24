<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TaxConditionController;
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
        Route::delete('/taxes/{tax}', [TaxController::class, 'delete']);
    });

    Route::get('/taxes', [TaxController::class, 'index']);
    Route::get('/taxes/{tax}', [TaxController::class, 'show']);

    Route::middleware('can:manage categories')->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'delete']);
    });

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    Route::middleware('can:manage categories')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'delete']);
    });

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    Route::middleware('can:manage categories')->group(function () {
        Route::post('/tax-conditions', [TaxConditionController::class, 'store']);
        Route::put('/tax-conditions/{tax_condition}', [TaxConditionController::class, 'update']);
        Route::delete('/tax-conditions/{tax_condition}', [TaxConditionController::class, 'delete']);
    });

    Route::get('/tax-conditions', [TaxConditionController::class, 'index']);
    Route::get('/tax-conditions/{tax_condition}', [TaxConditionController::class, 'show']);

    Route::middleware('can:manage categories')->group(function () {
        Route::get('/contacts/customers', [ContactController::class, 'customers']);
        Route::get('/contacts/suppliers', [ContactController::class, 'suppliers']);
        Route::post('/contacts', [ContactController::class, 'store']);
        Route::put('/contacts/{contact}', [ContactController::class, 'update']);
        Route::delete('/contacts/{contact}', [ContactController::class, 'delete']);
    });

    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/{contact}', [ContactController::class, 'show']);

    Route::middleware('can:manage categories')->group(function () {
        Route::post('/purchases/{purchase}/cancel', [PurchaseController::class, 'cancel']);
        Route::post('/purchases', [PurchaseController::class, 'store']);
        Route::put('/purchases/{purchase}', [PurchaseController::class, 'update']);
        Route::delete('/purchases/{purchase}', [PurchaseController::class, 'delete']);
    });

    Route::get('/purchases', [PurchaseController::class, 'index']);
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show']);

    Route::post('/inventory/movements', [InventoryMovementController::class, 'store']);
});
