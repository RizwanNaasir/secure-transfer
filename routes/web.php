<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/auth.php';
