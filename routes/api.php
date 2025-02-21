<?php

use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\DashBoardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProductController as TempController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', LoginController::class);
    Route::post('register', RegisterController::class);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('forgetpassword', [ResetPasswordController::class, 'send']);
    Route::post('email/verification',[EmailVerificationController::class,'store']);
    Route::post('email/verify',[EmailVerificationController::class,'verify']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [UserController::class, 'index']);
    Route::post('update', [LoginController::class, 'update']);

    Route::post('review',RatingController::class);

    Route::get('product', [ProductController::class, 'myProducts']);
    Route::post('payment-intent', [StripeController::class, 'paymentIntend']);
    });

Route::group(['prefix' => 'home','middleware' => 'auth:sanctum'],function (){
    Route::get('dashboard',DashBoardController::class);
});

Route::group(['prefix' => 'product', 'middleware' => 'auth:sanctum'], function () {
    Route::post('add', [ProductController::class, 'addProduct']);
    Route::get('all', [ProductController::class, 'allProducts']);
    /*Route::get('our-products', [ProductController::class, 'product']);*/
    Route::get('detail/{product}', [ProductController::class, 'productDetail'])->middleware('verify_document');
    Route::post('update/product', [ProductController::class, 'updateProduct']);
    Route::delete('delete/{product}', [ProductController::class, 'destroy']);
    Route::post('make-contract',[ProductController::class,'makeContract'])->middleware('verify_document');
});

Route::group(['prefix' => 'contract', 'middleware' => ['auth:sanctum', 'verify_document']], function () {
    Route::post('new', [ContractController::class, 'store']);
    Route::get('view', [ContractController::class, 'contractList']);
    Route::get('detail/{contract}', [ContractController::class, 'contractDetails']);
    Route::post('accept', [ContractController::class, 'acceptContract']);
    Route::post('delivered', [ContractController::class, 'deliveredContract']);
    Route::post('complete', [ContractController::class, 'completeContract']);
    Route::post('decline', [ContractController::class, 'declineContract']);


    Route::post('process',[ContractController::class,'process']);
});


Route::group(['prefix' => 'bank', 'middleware' => ['auth:sanctum']], function () {
    Route::post('detail', [StripeController::class, 'store']);
    Route::get('user-detail', [StripeController::class, 'show']);
});

Route::group(['prefix' => 'payout', 'middleware' => ['auth:sanctum']], function () {
    Route::post('submit-request', [StripeController::class, 'submitRequest']);
    Route::post('cancel-request', [StripeController::class, 'cancelSubmitRequest']);
    Route::get('request-detail', [StripeController::class, 'requestDetails']);
});

Route::group(['prefix' => 'wallet', 'middleware' => ['auth:sanctum']], function () {
    Route::get('balance-transaction', [StripeController::class, 'balanceTransaction']);
    Route::post('confirm-transaction', [StripeController::class, 'confirmTransaction']);
});


//Products
Route::post('/tmp-upload/{id}', [TempController::class, 'tmpUpload']);
