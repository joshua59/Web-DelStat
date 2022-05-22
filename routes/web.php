<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HasilKuisController;
use App\Http\Controllers\LiteraturController;
use App\Http\Controllers\AnalisisDataController;
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

    Route::prefix('users')->name('users.')->group(function(){
        Route::get('',  [UserController::class, 'index'])->name('index');
        Route::get('create',[UserController::class, 'create'])->name('create');
        Route::get('edit/{user}',  [UserController::class, 'edit'])->name('edit');
        Route::post('store',     [UserController::class, 'store'])->name('store');
        Route::post('update/{user}',   [UserController::class, 'update'])->name('update');
        Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    Route::prefix('hasilkuis')->name('hasilkuis.')->group(function(){
        Route::get('',  [HasilKuisController::class, 'index'])->name('index');
    });

    Route::prefix('literatur')->name('literatur.')->group(function(){
        Route::get('',  [LiteraturController::class, 'index'])->name('index');
        Route::get('create',[LiteraturController::class, 'create'])->name('create');
        Route::get('edit/{literatur}',  [LiteraturController::class, 'edit'])->name('edit');
        Route::post('store',     [LiteraturController::class, 'store'])->name('store');
        Route::post('update/{literatur}',   [LiteraturController::class, 'update'])->name('update');
        Route::delete('destroy/{literatur}', [LiteraturController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('analisisdata')->name('analisisdata.')->group(function(){
        Route::get('',  [AnalisisDataController::class, 'index'])->name('index');
        Route::post('update/{analisisdata}',   [AnalisisdataController::class, 'update'])->name('update');
    });
});
