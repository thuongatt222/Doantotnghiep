<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'account'], function () {
    Route::get('verify/{email}', [AccountController::class, 'verify'])->name('account.verify');
    Route::get('login', [AccountController::class, 'login'])->name('account.login');
    Route::post('login', [AccountController::class, 'check_login']);
    Route::get('register', [AccountController::class, 'register'])->name('account.register');
    Route::post('register', [AccountController::class, 'check_register']);
    Route::get('profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('profile', [AccountController::class, 'check_profile']);
    Route::get('change-password', [AccountController::class, 'change_password'])->name('account.change_password');
    Route::post('change-password', [AccountController::class, 'check_change_password']);
    Route::get('forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('forgot-password', [AccountController::class, 'check_forgot_password']);
    Route::get('reset-password/{email}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('reset-password', [AccountController::class, 'check_reset_password']);
});
Route::get('auth/google', [AccountController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AccountController::class, 'handleGoogleCallback']);

Route::group(['prefix' => 'customer'], function () {
    Route::get('home', function () { return view('customer/home'); })->name('customer.home');
    Route::get('single-product', function () { return view('customer/single-product'); })->name('customer.single-product');
    Route::get('blog', function () { return view('customer/blog'); })->name('customer.blog');
    Route::get('cart', function () { return view('customer/cart'); })->name('customer.cart');
    Route::get('single-blog', function () { return view('customer/single-blog'); })->name('customer.single-blog');
    Route::get('tracking', function () { return view('customer/tracking'); })->name('customer.tracking');
    Route::get('category', function () { return view('customer/category'); })->name('customer.category');
    Route::get('checkout', function () { return view('customer/checkout'); })->name('customer.checkout');
    Route::get('contact', function () { return view('customer/contact'); })->name('customer.contact');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('home', function () { return view('admin/home'); })->name('admin.home');
    Route::get('payment', function () { return view('admin/payment'); })->name('admin.payment');
    Route::get('shipping', function () { return view('admin/shipping'); })->name('admin.shipping');
    Route::get('admin', function () { return view('admin/admin'); })->name('admin.admin');
    Route::get('customer', function () { return view('admin/customer'); })->name('admin.customer');
    Route::get('brand', function () { return view('admin/brand'); })->name('admin.brand');
    Route::get('color', function () { return view('admin/color'); })->name('admin.color');
    Route::get('category', function () { return view('admin/category'); })->name('admin.category');
    Route::get('discount', function () { return view('admin/discount'); })->name('admin.discount');
    Route::get('order', function () { return view('admin/order'); })->name('admin.order');
    Route::get('product', function () { return view('admin/product'); })->name('admin.product');
    Route::get('size', function () { return view('admin/size'); })->name('admin.size');
    Route::get('voucher', function () { return view('admin/voucher'); })->name('admin.voucher');
});
