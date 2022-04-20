<?php

use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [UserApiController::class, 'login']);
Route::post('/register', [UserApiController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', [UserApiController::class, 'index']);
    Route::put('/user', [UserApiController::class, 'editProfile']);
    Route::put('/user/password', [UserApiController::class, 'editPassword']);
    Route::post('/logout', [UserApiController::class, 'logout']);
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
