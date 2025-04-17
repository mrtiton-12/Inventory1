<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



   Route::get('/categories',[CategoryController::class,'index']);
   Route::post('/categories/store', [CategoryController::class, 'store']);
   Route::get('/categories/show/{id}', [CategoryController::class, 'show']);
   Route::put('/categories/update/{id}', [CategoryController::class, 'update']); 
   Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy']);