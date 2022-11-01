<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
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

Route::get('SignUp',[FrontendController::class,'register']);
Route::get('SignIn',[FrontendController::class,'login']);
Route::get('forgetPassword',[FrontendController::class,'forget']);
Route::get('userProfile',[FrontendController::class,'profile']);
Route::get('home',[DashboardController::class,'index'])->name('home');
Route::get('add-contract',[DashboardController::class,'viewContractForm']);
Route::get('history',[DashboardController::class,'history']);
Route::get('detail',[DashboardController::class,'historyDetail']);
Route::get('card-detail',[DashboardController::class,'cardDetail']);
Route::get('payment',[DashboardController::class,'approvePayment']);
Route::get('description',[DashboardController::class,'description']);
Route::get('market_place',[DashboardController::class,'marketingView']);
Route::get('market_details',[DashboardController::class,'marketProduct']);
Route::get('success',[DashboardController::class,'successPayment']);

Route::group(['prefix' => 'contract', 'middleware' => ['web','auth'], 'as' => 'contract.'], function () {
    Route::get('list', [ContractController::class, 'list'])->name('list');
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

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('call/{command}', function ($command) {
        if ($command == 'migrate') {
            Artisan::call('migrate', ['--force' => true]);
        } else {
            Artisan::call($command);
        }
        return Artisan::output();
    });
});
