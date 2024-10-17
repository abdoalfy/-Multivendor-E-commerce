<?php

use App\Http\Controllers\Api\AccesstokenController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\PaymobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::user();
});
Route::apiResource('/products',ProductsController::class);
Route::post('/auth/accesstoken',[AccesstokenController::class,'store'])->middleware('guest:sanctum');
Route::delete('/auth/accesstoken/{token?}',[AccesstokenController::class,'destroy'])->middleware('auth:sanctum');
Route::post('checkout/processed',[PaymobController::class,'checkout_processed']);
