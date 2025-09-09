<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

// company routes
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/create', [CompanyController::class, 'create']);
Route::post('/companies', [CompanyController::class, 'store'])->middleware('auth');
Route::get('/companies/{company}', [CompanyController::class, 'show']);

// products routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// users routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

// recipients routes
Route::get('/recipients', [RecipientController::class, 'index']);
Route::get('/recipients/{recipient}', [RecipientController::class, 'show']);

// orders routes
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{order}', [OrderController::class, 'show']);

