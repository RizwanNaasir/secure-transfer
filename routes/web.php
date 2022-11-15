<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'user',
    'middleware' => ['web', 'auth'],
    'as' => 'user.'
], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    //    Payment method
    Route::get('create', [PaymentController::class, 'createCharge']);
    Route::get('showcharge', [PaymentController::class, 'showCharge']);
    Route::get('listcharge', [PaymentController::class, 'listCharges']);
    Route::get('cancelcharge', [PaymentController::class, 'cancelCharges']);
    Route::get('resolvecharge', [PaymentController::class, 'resolveCharges']);

    //checkout
    Route::get('checkoutlist', [PaymentController::class, 'listCheckout']);
    Route::get('newcheckout', [PaymentController::class, 'createCheckout']);
    Route::get('showcheckout', [PaymentController::class, 'showCheckout']);
    Route::get('updatecheckout', [PaymentController::class, 'updateCheckout']);
    Route::get('deletecheckout', [PaymentController::class, 'deleteCheckout']);
});

Route::get('home', [DashboardController::class, 'index'])->name('home');
Route::get('add-contract', [DashboardController::class, 'viewContractForm']);
Route::get('history', [DashboardController::class, 'history']);
Route::get('detail', [DashboardController::class, 'historyDetail']);
Route::get('card-detail', [DashboardController::class, 'cardDetail']);
Route::get('payment', [DashboardController::class, 'approvePayment']);
Route::get('description', [DashboardController::class, 'description']);
Route::get('market_place', [DashboardController::class, 'marketingView']);
Route::get('market_details', [DashboardController::class, 'marketProduct']);
Route::get('success', [DashboardController::class, 'successPayment']);
Route::get('rating', [DashboardController::class, 'starRating']);

Route::group([
    'prefix' => 'contract',
    'middleware' => ['web', 'auth','verify_document'],
    'as' => 'contract.'
], function () {
    Route::get('list/{tab}', [ContractController::class, 'list'])->name('list');
    Route::get('add-contract', [ContractController::class, 'viewContractForm'])->name('add-contract');
    Route::get('details/{contract}', [ContractController::class, 'details'])->name('details');
});
Route::get('contract/process', [ContractController::class, 'process'])->name('contract.process');


/*
|--------------------------------------------------------------------------
| Including all routes from auth folder
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('call/{command}', function ($command) {
        if ($command == 'migrate') {
            Artisan::call('migrate', ['--force' => true]);
        } else {
            Artisan::call($command);
        }
        return Artisan::output();
    });
});
