<?php

use App\Http\Controllers\AnalisisDataApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\HasilKuisApiController;
use App\Http\Controllers\LiteraturApiController;
use App\Http\Controllers\MateriApiController;
use App\Http\Controllers\NotifikasiApiController;
use App\Http\Controllers\ChatRoomApiController;
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

/* Unauthenticated UserApiController */
Route::post('/login', [UserApiController::class, 'login']);
Route::post('/register', [UserApiController::class, 'register']);
/* End of Unauthenticated UserApiController */

/* Unathenticated LiteraturApiController */
Route::get('/literatur', [LiteraturApiController::class, 'index']);
Route::get('/literatur/{id}', [LiteraturApiController::class, 'show']);
/* End of Unauthenticated LiteraturApiController */

/* Unauthenticated MaterialApiController */
Route::get('/materi/{id}', [MateriApiController::class, 'show']);
/* End of Unauthenticated MaterialApiController */

Route::middleware(['auth:api'])->group(function () {
    /* Authenticated UserApiController */
    Route::get('/user', [UserApiController::class, 'index']);
    Route::put('/user', [UserApiController::class, 'editProfile']);
    Route::put('/user/password', [UserApiController::class, 'editPassword']);
    Route::post('/logout', [UserApiController::class, 'logout']);
    /* End of Authenticated UserApiController */

    /* HasilKuisApiController */
    Route::get("/hasilkuis", [HasilKuisApiController::class, 'index']);
    Route::get("/hasilkuis/{id}", [HasilKuisApiController::class, 'indexByIdKuis']);
    Route::post("/hasilkuis/store", [HasilKuisApiController::class, 'store']);
    /* End of HasilKuisApiController */

    /* LiteraturApiController */
    Route::post("/literatur/store", [LiteraturApiController::class, 'store']);
    Route::put("/literatur/{id}", [LiteraturApiController::class, 'update']);
    Route::delete("/literatur/{id}", [LiteraturApiController::class, 'destroy']);
    /* End of LiteraturApiController */

    /* AnalisisDataApiController */
    Route::get("/analisisdata", [AnalisisDataApiController::class, 'index']);
    Route::get("/analisisdata/{id}", [AnalisisDataApiController::class, 'show']);
    Route::post("/analisisdata/store", [AnalisisDataApiController::class, 'store']);
    Route::put("/analisisdata/{id}", [AnalisisDataApiController::class, 'update']);
    Route::put("/analisisdata/cancel/{id}", [AnalisisDataApiController::class, 'cancelOrderAnalisisData']);
    /* End of AnalisisDataApiController */

    /* Authenticated MateriApiController */
    Route::put("/materi/{id}", [MateriApiController::class, 'update']);
    /* End of Authenticated MateriApiController */

    /* NotifikasiApiController */
    Route::get("/notifikasi", [NotifikasiApiController::class, 'index']);
    /* End of NotifikasiApiController */

    /* ChatRoomApiController */
    Route::get("/chatroom", [ChatRoomApiController::class, 'index']);
    Route::post("/chatroom/store", [ChatRoomApiController::class, 'storeNewChatRoom']);
    Route::get("/chatroom/{id}", [ChatRoomApiController::class, 'show']);
    Route::post("/chatroom/{id}/store", [ChatRoomApiController::class, 'storeNewChat']);
    /* End of ChatRoomApiController */
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
