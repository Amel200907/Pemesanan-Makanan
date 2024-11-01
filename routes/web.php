<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\ReviewController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::resource('products', ProductController::class);
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('status.update');
    });
});

Route::middleware(['auth', 'checkRole:customer'])->prefix('customer')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('customer.menu');
        Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/{cartItem}', [CartController::class, 'remove'])->name('remove');
    });
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [CustomerOrderController::class, 'index'])->name('index');
        Route::post('/', [CustomerOrderController::class, 'store'])->name('store');
        Route::get('/{order}', [CustomerOrderController::class, 'show'])->name('show');
    });
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Public Routes
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');
