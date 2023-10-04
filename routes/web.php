<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use RizwanNasir\MtnMomo\MtnCollection;
use RizwanNasir\MtnMomo\MtnConfig;

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
//Route::get('call/{command}', function ($command) {
//    Artisan::call($command);
//    return Artisan::output();
//});

Route::get('/', function () {
    return view('welcome');
});

Route::get('language/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

/*Route::group([
    'prefix' => 'wallet',
    'middleware' => ['web', 'auth'],
], function (){
    Route::get('checkout', [WalletController::class, 'checkWallet'])->name('check-wallet');
});*/


Route::group([
    'prefix' => 'stripe',
    'middleware' => ['web', 'auth'],
], function (){
   /* Route::get('checkout', [StripeController::class, 'checkOut'])->name('checkout');
    Route::post('checkout-payment', [StripeController::class, 'checkoutDetails'])->name('checkout-details');*/
    Route::get('payment', [StripeController::class, 'index'])->name('payment');
    Route::get('wallet', [StripeController::class, 'topUpWallet'])->name('stripe.top-up-wallet');
});

Route::group([
    'prefix' => 'user',
    'middleware' => ['web', 'auth'],
    'as' => 'user.'
], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    //products
    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::post('add/product', [ProductController::class, 'addProduct']);
    Route::get('product-list', [ProductController::class, 'productList'])->name('product-list');
    Route::get('edit-product/{product}', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::delete('delete-product/{product}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::post('update-product/{id}', [ProductController::class, 'updateProduct']);

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

/*Frontend pages*/

Route::group([
    '/{locale}',
], function ($locale) {

Route::get('home', [DashboardController::class, 'index'])->name('home');
Route::get('add-contract', [DashboardController::class, 'viewContractForm']);
Route::get('history', [DashboardController::class, 'history']);
Route::get('detail', [DashboardController::class, 'historyDetail']);
Route::get('card-detail', [DashboardController::class, 'cardDetail']);
Route::get('payment', [DashboardController::class, 'approvePayment']);
Route::get('description', [DashboardController::class, 'description']);
Route::get('market_place', [DashboardController::class, 'marketingView'])->name('all.products');
Route::get('market_details/{id}', [DashboardController::class, 'marketProduct'])->name('product.details');
Route::get('success', [DashboardController::class, 'successPayment']);
Route::get('rating', [DashboardController::class, 'starRating']);
});
Route::group([
    'prefix' => 'contract',
    'middleware' => ['web', 'auth', 'verify_document'],
    'as' => 'contract.'
], function () {
    Route::get('list/{tab}', [ContractController::class, 'list'])->name('list');
    Route::get('add-contract', [ContractController::class, 'viewContractForm'])->name('add-contract');
    Route::get('details/{contract}', [ContractController::class, 'details'])->name('details');
    Route::post('accept/{contract}', [ContractController::class, 'acceptContract'])->name('accepted');
    Route::post('decline/{contract}', [ContractController::class, 'declineContract'])->name('declined');
});
Route::get('contract/process', [ContractController::class, 'process'])->name('contract.process');


Route::get('mtn',function (){
    $config = new  MtnConfig(config('mtn-momo'));
    $collection = new MtnCollection($config);

    $params = [
        "mobileNumber"      => '233540000000',
        "amount"            => '100',
        "externalId"        => '774747234',
        "payerMessage"      => 'some note',
        "payeeNote"         => '1212'
    ];

    $transactionId = $collection->requestToPay($params);

    $transaction = $collection->getTransaction($transactionId);

    dd($transaction);
});

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
Route::post('user/update',[UserController::class,'update']);
Route::get('/remove-message', function (){
    Session::forget('message');
});
Route::stripeWebhooks('stripe/webhook');
