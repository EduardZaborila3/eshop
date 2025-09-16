<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UserController;
use App\Mail\Mail\OrderCreated;
use Illuminate\Support\Facades\Route;


Route::get('test', function() {
   \Illuminate\Support\Facades\Mail::to('edi@eshop.com')->send(new OrderCreated());
   return 'Done';
});

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

    // users routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// company routes
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::patch('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

// products routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// recipients routes
    Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index');
    Route::get('/recipients/create', [RecipientController::class, 'create'])->name('recipients.create');
    Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::get('/recipients/{recipient}', [RecipientController::class, 'show'])->name('recipients.show');
    Route::get('/recipients/{recipient}/edit', [RecipientController::class, 'edit'])->name('recipients.edit');
    Route::patch('/recipients/{recipient}', [RecipientController::class, 'update'])->name('recipients.update');
    Route::delete('/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');

// orders routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/companies/{company}/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/companies/{company}/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

require __DIR__.'/auth.php';

require __DIR__ . '/auth.php';

Route::view('/', 'home');




