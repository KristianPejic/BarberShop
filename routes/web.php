<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


Route::get('/', [ProductController::class, 'index']);
Route::get('/shop/search', [SearchController::class, 'index']);
Route::get('/shop/filter', [FilterController::class, 'index']);

Route::get('/shop', [ProductController::class, 'shop']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show_product');


// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// User's Orders Route (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('user_orders');
});

Route::middleware(['auth', 'MustBeAdmin'])->group(function () {
    Route::get('/all-orders', [OrderController::class, 'adminAllOrders'])->name('all_orders');
});
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place_order');
Route::patch('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

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
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/user', [ReservationController::class, 'userReservations'])->name('user_reservations');
    Route::delete('/reservations/user/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
