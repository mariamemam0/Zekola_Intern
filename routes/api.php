<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::controller(\App\Http\Controllers\TestController::class)

->group(function(){
    Route::get('/test','index');

    Route::post('/test','store');

    Route::put('test/{id}','update');
    Route::delete('test/{id}','destroy');
});

Route::apiResource('/users',\App\Http\Controllers\UserController::class);
Route::apiResource('/products',\App\Http\Controllers\ProductController::class);
Route::apiResource('/orders',\App\Http\Controllers\OrderController::class);
