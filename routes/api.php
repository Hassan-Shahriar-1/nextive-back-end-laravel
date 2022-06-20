<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\custom_log;
use App\Http\Controllers\PostController;
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
Route::get('/post/list',[PostController::class,'post_list']);
Route::get('/post/{category}',[PostController::class,'post_by_category']);
Route::post('/login',[custom_log::class,'login']);
Route::post('/logout',[custom_log::class,'logout']);
Route::group(['prefix'=>'category','middleware'=>'jwt'],function(){
    Route::post('/create',[CategoryController::class,'create']);
    Route::get('/list',[CategoryController::class,'category_for_insert_page']);
});
Route::group(['prefix'=>'posts','middleware'=>'jwt'],function(){
    Route::post('/create',[PostController::class,'post_insert']);
    Route::get('edit/{postid}',[PostController::class,'edit']);
    Route::post('/update/post',[PostController::class,'update']);
    Route::get('/delete/{postid}',[PostController::class,'delete']);
});
