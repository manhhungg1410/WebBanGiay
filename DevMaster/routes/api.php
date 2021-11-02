<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send-guest',[\App\Http\Controllers\SendEmailController::class,'send_guest']);
Route::post('send-email',[\App\Http\Controllers\SendEmailController::class,'send_contact']);
Route::post('details_ajax/{id}',[\App\Http\Controllers\ShopController::class,'details_ajax']);
