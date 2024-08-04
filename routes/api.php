<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
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




Route::post('register',[AuthController::class,'register'])->middleware('guest:sanctum');
Route::post('login',[AuthController::class,'login'])->middleware('guest:sanctum');
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');



Route::post('admin/addFood',[FoodsController::class,'addFood'])->middleware('auth:sanctum');
Route::post('admin/editFood/{FoodId}',[FoodsController::class,'editFood'])->middleware('auth:sanctum');
Route::delete('admin/deleteFood/{FoodId}',[FoodsController::class,'deleteFood'])->middleware('auth:sanctum');



Route::get('admin/allFood',[HomeController::class,'allFood'])->middleware('auth:sanctum');
Route::get('user/allFood',[HomeController::class,'allFood']);

Route::get('admin/search',[HomeController::class,'search'])->middleware('auth:sanctum');
Route::get('user/search',[HomeController::class,'search']);


Route::post('addReview',[ReviewController::class,'addReview'])->middleware('auth:sanctum');
Route::delete('deleteReview/{food_id}',[ReviewController::class,'deleteReview'])->middleware('auth:sanctum');
Route::get('reviewForFood/{food_id}',[ReviewController::class,'reviewForFood']);

