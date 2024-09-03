<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/shop/search', [SearchController::class, 'index']);
Route::get('/shop/filter', [FilterController::class, 'index']);

Route::get('/shop', [ProductController::class, 'shop']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show_product');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('MustBeAdmin')->group(function () {
    Route::get('/products', [ProductController::class, 'admin'])->name('products');
    Route::get('/product/search', [SearchController::class, 'admin']);
    Route::get('/product/filter', [FilterController::class, 'admin']);
    Route::post('/products', [ProductController::class, 'store'])->name('products');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product_create');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product_edit');
    Route::patch('/product/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product_destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
