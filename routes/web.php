<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () { return view('welcome'); });

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/shops', [App\Http\Controllers\ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/{slug}', [App\Http\Controllers\ShopController::class, 'show'])->name('shops.show');
Route::get('/recommendations', [App\Http\Controllers\RecommendationController::class, 'index'])->name('recommendations.index');
Route::post('/recommendations', [App\Http\Controllers\RecommendationController::class, 'recommend'])->name('recommendations.get');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'shop_owner') {
        return redirect()->route('shop.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/shop/dashboard', [App\Http\Controllers\ShopDashboardController::class, 'index'])->name('shop.dashboard');
    Route::patch('/shop/orders/{order}/status', [App\Http\Controllers\ShopDashboardController::class, 'updateStatus'])->name('shop.orders.status');
});

require __DIR__.'/auth.php';