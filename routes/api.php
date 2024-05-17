<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SizeController;
use App\Http\Resources\SizeConllection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::prefix('size')->group(function () {
//     Route::get('show', [SizeController::class, 'index'])->name('size_show');
//     Route::post('update', [SizeController::class, 'update'])->name('size_update');
//     Route::post('insert', [SizeController::class, 'store'])->name('size_insert');
//     Route::post('destroy', [SizeController::class, 'destroy'])->name('size_destroy');
// });
Route::apiResource('size', SizeController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('brand', BrandController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('product', ProductController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('category', CategoryController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('color', ColorController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('payment', PaymentController::class)->only('index', 'store', 'show', 'update', 'destroy');
Route::apiResource('shipping', ShippingController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('productdetail', ProductDetailController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('orderdetail', OrderDetailController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('order', OrderController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('discount', DiscountController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('voucher', DiscountController::class)->only('index', 'store', 'update', 'destroy', 'show');
Route::apiResource('favourite', DiscountController::class)->only('index', 'store','destroy');
Route::post('/cart', [OrderDetailController::class, 'cart']);
Route::delete('/cart/remove', [OrderDetailController::class, 'removeFromCart']);
Route::get('/cart', [OrderDetailController::class, 'showCart']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AccountController::class, 'login']);
    Route::post('logout', [AccountController::class, 'logout']);
    Route::post('refresh', [AccountController::class, 'refresh']);
    Route::post('me', [AccountController::class, 'me']);

});