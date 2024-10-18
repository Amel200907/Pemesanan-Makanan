<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    

    Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/rate/{order}', [OrderController::class, 'rate'])->name('order.rate');
});

    Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/products/{product}/rate', [ProductController::class, 'rate'])->name('products.rate');
Route::post('/products/{product}/like', [ProductController::class, 'like'])->name('products.like');
});
