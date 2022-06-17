<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\custom_log;
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

Route::post('/login',[custom_log::class,'login']);
Route::group(['prefix'=>'category','middleware'=>'jwt'],function(){
    Route::post('/create',[CategoryController::class,'create']);
});
