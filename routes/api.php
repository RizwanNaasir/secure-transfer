<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProductController as TempController;
use App\Models\Contract;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\ProductController;

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
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [UserController::class, 'index']);
    Route::post('update', [LoginController::class, 'update']);
    Route::get('product/all', [ProductController::class, 'allProducts']);
    Route::get('product', [ProductController::class, 'product']);
    Route::get('product/detail/{id}', [ProductController::class, 'productDetail']);
    Route::post('update/product',[ProductController::class,'updateProduct']);
});

Route::group(['prefix'=>'contract','middleware' => ['auth:sanctum','verify_document']],function (){
    Route::post('new',[ContractController::class,'store']);
    Route::get('view',[ContractController::class,'contractlist']);
    Route::get('detail/{contract}',[ContractController::class,'contractDetails']);
    Route::post('accept/{contract}',[ContractController::class,'acceptContract']);
    Route::post('decline/{contract}',[ContractController::class,'declineContract']);
});

//Products
Route::post('/tmp-upload/{id}',[TempController::class, 'tmpUpload']);
Route::delete('/tmp-delete',[TempController::class, 'tmpDelete']);
