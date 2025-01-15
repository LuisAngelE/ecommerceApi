<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\StatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/users', UsersController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductsController::class);
    Route::resource('/addresses', AddressesController::class);
    Route::resource('/states', StatesController::class);

    Route::get('/states/municipalities/{id}', [StatesController::class, 'getMunicipalitiesByState']);
    Route::post('/product/{id}', [ProductsController::class, 'uploadImage']);
});
