<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
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


Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);
Route::middleware('auth:sanctum')->group(function(){
    //User CRUD
    Route::resource('/user' , UserController::class);
    //Product Crud
    Route::resource('/product' , ProductController::class);
    //Create Product With Different Prices Based On User Type
    Route::post('/create/different/prices' , [ProductController::class , 'createWithPriceModifiers']);
    //Show Prices for logged In User
    Route::get('show/prices/{product}' , [ProductController::class , 'showSpecificProductPriceForLoggedInUser']);
});
