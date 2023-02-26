<?php

use App\Http\Controllers\API\Payments\PaymentMethodController;
use App\Http\Controllers\API\Products\ProductController;
use App\Http\Controllers\API\ShoppingSession\SessionController;
use App\Http\Controllers\API\ShoppingSession\ShopInformationController;
use App\Http\Controllers\API\Transaction\TransactionController;
use App\Http\Middleware\ShopIsExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Create Session Shopping
 */
Route::post('/session/create',[SessionController::class, 'createSession']);

/**
 * Display All Product
 */

Route::middleware([ShopIsExists::class])
    ->prefix('shop')->group(function () {
        Route::prefix('exists')->group(function () {
            Route::get('/{shopcode}',[ShopInformationController::class, 'isExists']);
        });
        Route::prefix('information')->group(function () {
            Route::get('/{shopcode}',[ShopInformationController::class, 'getOwnerInformation']);
        });
        Route::prefix('products')->group(function () {
            Route::get('/{shopcode}/',[ProductController::class, 'getAllProduct']);
            Route::get('/{shopcode}/{id}',[ProductController::class, 'getSingleProduct']);
        });
    });

Route::prefix('payment')->group(function () {
        Route::prefix('method')->group(function () {
            Route::get('/',[PaymentMethodController::class, 'getAllPaymentMethod']);
            Route::post('/',[PaymentMethodController::class, 'create']);
        });
    });

Route::prefix('transaction')->group(function () {
    Route::get('/{sessionid}/historyorder',[TransactionController::class, 'orderlistHistory']);
    Route::get('/{invoicenumber}',[TransactionController::class, 'responsePayment']);
    Route::post('/',[TransactionController::class, 'create']);
});
