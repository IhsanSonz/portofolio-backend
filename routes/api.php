<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

//database truncate
Route::get('delete', [UserController::class, 'truncate']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['middleware' => 'jwt.verify'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user-info', [AuthController::class, 'getUser']);

    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);

    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'show']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);

    Route::get('tag', [TagController::class, 'index']);
    Route::get('tag/{id}', [TagController::class, 'show']);
    Route::post('tag', [TagController::class, 'store']);
    Route::put('tag/{id}', [TagController::class, 'update']);
    Route::delete('tag/{id}', [TagController::class, 'destroy']);

    Route::get('product_det', [ProductDetController::class, 'index']);
    Route::get('product_det/{id}', [ProductDetController::class, 'show']);
    Route::post('product_det', [ProductDetController::class, 'store']);
    Route::put('product_det/{id}', [ProductDetController::class, 'update']);
    Route::delete('product_det/{id}', [ProductDetController::class, 'destroy']);

});
