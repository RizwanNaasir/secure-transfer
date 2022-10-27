<?php

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

require __DIR__.'/auth.php';

Route::group(['middleware' => ['web']], function () {
    Route::get('call/{command}', function ($command) {
        if($command == 'migrate'){
            Artisan::call('migrate',['--force' => true]);
        }else{
            Artisan::call($command);
        }
        return Artisan::output();
    });
});
