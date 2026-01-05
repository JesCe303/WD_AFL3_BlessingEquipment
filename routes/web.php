<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Public Pages - Accessible by everyone (guest, customer, admin)
 * Homepage: Landing page with hero, features, categories, branches
 * About: Company information, location, values, history
 */
Route::get('/', function () {
    return view('pages.homepage');
});

Route::get('/about', function () {
    return view('pages.about');
});

/**
 * Auth Routes - Login, Register, Password Reset
 * Provided by Laravel Breeze
 */
require __DIR__.'/auth.php';

/**
 * Admin-Only Routes - Protected by 'admin' middleware
 * Only users with role='admin' can access these routes
 * Includes: Branch Management, Category Management, Product CRUD
 */
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Branch Management Routes (Admin only)
    Route::get('/branch', [BranchController::class, 'index'])->name('branch.index');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
    
    // Category Management Routes (Admin only)
    Route::resource('/category', CategoryController::class);
    
    // Product Management Routes (Admin only - CRUD operations)
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

/**
 * Product View Routes - Accessible by everyone (for customer shopping)
 * Customer can view product list and details
 * Admin can also access for management purposes
 */
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

/**
 * Customer Cart Routes - Protected by auth middleware
 * Customers can add to cart, view cart, update quantity, remove items
 */
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CheckoutController;

Route::middleware(['auth', 'customer'])->group(function () {
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Favorite routes
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
    
    // Checkout routes
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/retry/{orderNumber}', [CheckoutController::class, 'retryPayment'])->name('checkout.retry');
});

// Midtrans callback (no auth/CSRF protection needed)
Route::post('/midtrans/callback', [CheckoutController::class, 'callback']);

/**
 * Dashboard & Profile - For authenticated users
 */
Route::middleware('auth')->group(function () {
    /**
     * Dashboard route - Redirects based on user role after login
     * Admin -> /product (product management page)
     * Customer -> / (homepage to start shopping)
     */
    Route::get('/dashboard', function () {
        // Get current logged-in user's role from database
        if (Auth::user()->role === 'admin') {
            return redirect('/product'); // Admin goes to product management
        }
        return redirect('/'); // Customer stays on homepage
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
