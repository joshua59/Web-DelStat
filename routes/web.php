<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('auth',[AuthController::class, 'index'])->name('auth');
Route::post('login',[AuthController::class, 'do_login'])->name('login');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('logout',[AuthController::class, 'do_logout'])->name('logout');
});
Route::group(['middleware' => 'auth:web','verified'], function () {
    Route::get('/', function(){
        return redirect()->route('home');
    });
    Route::get('home',[HomeController::class, 'index'])->name('home');
    // Route::get('{users:nama}', [HomeController::class,'show']);

    Route::get('users',[UserController::class, 'index'])->name('users');
    Route::post('users/store',[UserController::class, 'store'])->name('users_store');

    
});
