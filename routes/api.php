<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PictureLibraryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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

Route::group(['middleware' => 'cors'], function () {

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
    Route::apiResource('user', UserController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('brand', BrandController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('product', ProductController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('category', CategoryController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('color', ColorController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('payment', PaymentController::class)->only('index', 'store', 'show', 'update', 'destroy');
    Route::apiResource('shipping', ShippingController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('productdetail', ProductDetailController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('orderdetail', OrderDetailController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('voucher', VoucherController::class)->only('index', 'store', 'update', 'destroy', 'show');
    Route::apiResource('favourite', FavouriteController::class)->only('index', 'store', 'destroy');
    Route::apiResource('library', PictureLibraryController::class)->only('index', 'store', 'destroy', 'show');
    Route::get('verify/{id}', [AccountController::class, 'verifyEmail'])->name('account.verify');
    Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {

        Route::post('login', [AccountController::class, 'login']);
        Route::post('register', [AccountController::class, 'register']);
        Route::post('logout', [AccountController::class, 'logout']);
        Route::post('refresh', [AccountController::class, 'refresh']);
        Route::post('me', [AccountController::class, 'me']);
    });
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('order', OrderController::class)->only('index', 'store', 'update', 'destroy', 'show');
        Route::apiResource('cart', CartController::class)->only('index', 'store', 'update', 'destroy', 'show');
        Route::post('add-to-cart', [CartController::class, 'cart']);
        Route::post('password/change', [AccountController::class, 'changePassword']);
    });
});
