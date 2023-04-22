<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('post',[PostController::class,'index']);
Route::post('post',[PostController::class,'store']);
Route::put('post/{id}',[PostController::class,'update']);
Route::delete('post/{id}',[PostController::class,'destroy']);
Route::get('post/{id}',[PostController::class,'show']);

Route::get('tag',[TagController::class,'index']);
Route::post('tag',[TagController::class,'store']);
Route::put('tag/{id}',[TagController::class,'update']);
Route::delete('tag/{id}',[TagController::class,'destroy']);
Route::get('tag/{id}',[TagController::class,'show']);
Route::get('post_tag/{id}',[PostController::class,'postAndTag']);
Route::get('post_tag',[PostController::class,'post_AndTag']);

Route::get('user',[UserController::class,'index']);
Route::post('user',[UserController::class,'store']);
Route::put('user/{id}',[UserController::class,'update']);
Route::delete('user/{id}',[UserController::class,'destroy']);
Route::get('user/{id}',[UserController::class,'show']);
Route::get('user_post/{id}',[UserController::class,'userAndpost']);
Route::get('users',[UserController::class,'usersAndPosts']);
