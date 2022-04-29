<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\OfficeController;

Route::group(['domain' => ''], function() {
    Route::prefix('')->name('office.')->group(function(){
        Route::get('/home',[OfficeController::class, 'index']);
        Route::get('/login',[OfficeController::class, 'auth']);
        Route::get('/users',[OfficeController::class, 'users'])->name('users');
    });
});