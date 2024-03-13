<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;


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
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'loginUser']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [UserController::class, 'userDetails']);
    Route::get('brand', [HomeController::class, 'brand']);
    Route::get('category', [HomeController::class, 'category']);
    Route::get('subcategory/{id?}', [HomeController::class, 'subcategory']);
    Route::get('product/{brand_id?}/{category_id?}/{subcategory_id?}', [HomeController::class, 'product']);
    Route::get('logout', [UserController::class, 'logout']);
});
