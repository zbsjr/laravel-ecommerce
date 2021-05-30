<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::get('users/{user}/orders', [UserController::class, 'showOrders']);
    Route::patch('products/{product}/quantity/add', [ProductController::class, 'updateQuantity']);
    Route::patch('orders/{order}/deliver', [OrderController::class, 'deliverOrder']);
    Route::post('/upload-file', [ProductController::class, 'uploadFile']);
    Route::resource('orders', OrderController::class)->except(['store']);;
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});
