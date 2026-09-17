<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomizationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'productDetails'])->name('product.details');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/unsubscribe/{email?}', [HomeController::class, 'unsubscribe'])->name('unsubscribe');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::middleware(['auth', 'role:admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Profile & Password
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/password', [AdminController::class, 'password'])->name('password');
    Route::post('/password', [AdminController::class, 'updatePassword'])->name('password.update');

    // Categories Management
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::post('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    // Products Management
    Route::resource('products', ProductController::class)->except(['show']);
    Route::post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');

    // Testimonials Management & Section Settings
    Route::resource('testimonials', TestimonialController::class)->except(['create', 'show', 'edit']);
    Route::post('/testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
    Route::post('/testimonials/section-settings', [TestimonialController::class, 'updateSection'])->name('testimonials.section.update');

    // FAQ Management & Section Settings
    Route::resource('faqs', FaqController::class)->except(['create', 'show', 'edit']);
    Route::post('/faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');
    Route::post('/faqs/section-settings', [FaqController::class, 'updateSection'])->name('faqs.section.update');

    // Customization Routes
    Route::prefix('/customization')->name('customization.')->group(function () {
        Route::get('/top-nav', [CustomizationController::class, 'topnav'])->name('topnav');
        Route::post('/top-nav', [CustomizationController::class, 'updateTopnav'])->name('topnav.update');
        Route::get('/banner', [CustomizationController::class, 'banner'])->name('banner');
        Route::post('/banner', [CustomizationController::class, 'updateBanner'])->name('banner.update');
        Route::get('/cta', [CustomizationController::class, 'cta'])->name('cta');
        Route::post('/cta', [CustomizationController::class, 'updateCta'])->name('cta.update');
    });
});

Route::middleware(['auth', 'role:user'])->prefix('/user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
