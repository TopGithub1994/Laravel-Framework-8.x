<?php

use App\Http\Controllers\ProductionController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductionController::class, 'index']);
Route::get('/products/{id}', [ProductionController::class, 'show']);
Route::get('/products/search/{name}', [ProductionController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ProductionController::class, 'store']);
    Route::put('/products/{id}', [ProductionController::class, 'update']);
    Route::delete('/products/{id}', [ProductionController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('ssi/insert_ssi_historical',[ApiController::class,'insert_ssi_historical']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
