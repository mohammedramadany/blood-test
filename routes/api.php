<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonateSchedualController;
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

Route::post('register',[AuthController::class,'register']);

Route::post('login',[AuthController::class,'login']);


// Route::apiResource('donate',DonateSchedualController::class)->middleware('auth');


Route::controller(DonateSchedualController::class)->middleware('auth')->group(function(){
    Route::get('donate','index');
    Route::post('donate','store');
    Route::post('donate/{schedual_id}','show');
    Route::put('donate/{schedual_id}','update');

});
