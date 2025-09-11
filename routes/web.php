<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');


// users routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::patch('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

// company routes
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/create', [CompanyController::class, 'create']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit']);
Route::patch('/companies/{company}', [CompanyController::class, 'update']);
Route::delete('/companies/{company}', [CompanyController::class, 'destroy']);

// products routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
Route::patch('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);

// recipients routes
Route::get('/recipients', [RecipientController::class, 'index']);
Route::get('/recipients/create', [RecipientController::class, 'create']);
Route::post('/recipients', [RecipientController::class, 'store']);
Route::get('/recipients/{recipient}', [RecipientController::class, 'show']);
Route::get('/recipients/{recipient}/edit', [RecipientController::class, 'edit']);
Route::patch('/recipients/{recipient}', [RecipientController::class, 'update']);
Route::delete('/recipients/{recipient}', [RecipientController::class, 'destroy']);

// orders routes
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{order}', [OrderController::class, 'show']);

Route::get('/companies/{company}/orders/create', [OrderController::class, 'create']);
Route::post('/companies/{company}/orders', [OrderController::class, 'store']);

