<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:slug}/products', [CategoryController::class, 'showProducts'])->name('categories.products');

// Authentication routes
require __DIR__ . '/auth.php';

// Vendor registration
Route::get('/vendor/register', [VendorController::class, 'showRegistrationForm'])->name('vendor.register');
Route::post('/vendor/register', [VendorController::class, 'register'])->name('vendor.register.submit');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart (only for customers)
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::patch('/cart/update/{item}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'removeCartItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    // Checkout (only for customers)
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/payment-callback', [CheckoutController::class, 'paymentCallback'])->name('checkout.payment-callback');

    // Orders (only for customers)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

    // Reviews (only for customers)
    Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // Vendor routes (only for approved vendors)
    Route::middleware(['vendor.approved'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [VendorController::class, 'profile'])->name('profile');
        Route::patch('/profile', [VendorController::class, 'updateProfile'])->name('profile.update');

        // Vendor product management
        Route::get('/products', [ProductController::class, 'vendorProducts'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Vendor orders
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'vendorOrders'])->name('orders.index');
        Route::patch('/orders/{order}/update-status', [\App\Http\Controllers\OrderController::class, 'vendorUpdateStatus'])->name('orders.update-status');
        Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'vendorShowOrder'])->name('orders.show');
    });

    // Admin routes
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // User management
        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        // Vendor management
        Route::get('/vendors', [App\Http\Controllers\Admin\UserController::class, 'vendors'])->name('vendors.index');
        Route::patch('/vendors/{user}/approve', [App\Http\Controllers\Admin\UserController::class, 'approveVendor'])->name('vendors.approve');
        Route::patch('/vendors/{user}/reject', [App\Http\Controllers\Admin\UserController::class, 'rejectVendor'])->name('vendors.reject');

        // Category management
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

        // Product management
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

        // Order management
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::delete('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

        // Review management
        Route::get('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
    });
});

Route::get('/test-email', function () {
    Mail::raw('Test email SMTP Laravel', function ($message) {
        $message->to('ibanihillabi2007@gmail.com')
            ->subject('Test Email SMTP');
    });
    return 'Email sent';
});
