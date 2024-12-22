<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginLogoutController;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes for ToyController
    Route::resource('toys', ToyController::class);

    // Routes for CategoryController
    Route::resource('categories', CategoryController::class);
});

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login routes
Route::get('/login', [LoginLogoutController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginLogoutController::class, 'login']);

// Logout route
Route::post('/logout', [LoginLogoutController::class, 'logout'])->name('logout');

// Admin User Routes
Route::prefix('admin/users')->group(function () {
    Route::get('/', [AdminUserController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/create', [AdminUserController::class, 'createUser'])->name('admin.users.create');
    Route::post('/store', [AdminUserController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/edit/{id}', [AdminUserController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/update/{id}', [AdminUserController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/delete/{id}', [AdminUserController::class, 'destroyUser'])->name('admin.users.delete');
});

// Admin Seller Routes
Route::prefix('admin/sellers')->group(function () {
    Route::get('/', [AdminUserController::class, 'indexSellers'])->name('admin.sellers.index');
    Route::get('/create', [AdminUserController::class, 'createSeller'])->name('admin.sellers.create');
    Route::post('/store', [AdminUserController::class, 'storeSeller'])->name('admin.sellers.store');
    Route::get('/edit/{id}', [AdminUserController::class, 'editSeller'])->name('admin.sellers.edit');
    Route::post('/update/{id}', [AdminUserController::class, 'updateSeller'])->name('admin.sellers.update');
    Route::delete('/delete/{id}', [AdminUserController::class, 'destroySeller'])->name('admin.sellers.delete');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/', function () {
    return view('welcome');
});
