<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UserController;
use App\Models\User;
require __DIR__ . '/auth.php';

Route::view('/', 'home');


// users routes
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');

// company routes
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index')->middleware('auth');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create')->middleware('auth');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show')->middleware('auth');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store')->middleware('auth');
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit')->middleware('auth');
Route::patch('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update')->middleware('auth');
Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy')->middleware('auth');

// products routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');

// recipients routes
Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index')->middleware('auth');
Route::get('/recipients/create', [RecipientController::class, 'create'])->name('recipients.create')->middleware('auth');
Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store')->middleware('auth');
Route::get('/recipients/{recipient}', [RecipientController::class, 'show'])->name('recipients.show')->middleware('auth');
Route::get('/recipients/{recipient}/edit', [RecipientController::class, 'edit'])->name('recipients.edit')->middleware('auth');
Route::patch('/recipients/{recipient}', [RecipientController::class, 'update'])->name('recipients.update')->middleware('auth');
Route::delete('/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy')->middleware('auth');

// orders routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/companies/{company}/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('auth');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');
Route::post('/companies/{company}/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware('auth');
Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware('auth');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('auth');

