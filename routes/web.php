<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;

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
Route::get('marketing',[DashboardController::class,'marketingView']);
Route::get('success',[DashboardController::class,'successPayment']);
Route::get('SignUp', [FrontendController::class, 'register']);
Route::get('SignIn', [FrontendController::class, 'login']);
Route::get('forgetPassword', [FrontendController::class, 'forget']);
Route::get('userProfile', [FrontendController::class, 'profile']);
Route::get('home', [DashboardController::class, 'index'])->name('home');
Route::get('add-contract', [DashboardController::class, 'viewContractForm']);
Route::get('detail', [DashboardController::class, 'historyDetail']);

Route::group(['prefix' => 'contract', 'middleware' => ['web','auth'], 'as' => 'contract.'], function () {
    Route::get('list', [ContractController::class, 'list'])->name('list');
});


require __DIR__ . '/auth.php';

Route::group(['middleware' => ['web']], function () {
    Route::get('call/{command}', function ($command) {
        if ($command == 'migrate') {
            Artisan::call('migrate', ['--force' => true]);
        } else {
            Artisan::call($command);
        }
        return Artisan::output();
    });
});
