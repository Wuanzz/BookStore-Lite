<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\PublisherApiController; // Khai báo thêm Controller mới

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Hệ thống Quản lý Sách
Route::get('/books', [BookApiController::class, 'index']);      
Route::get('/books/{id}', [BookApiController::class, 'show']);   
Route::post('/books', [BookApiController::class, 'store']);      
Route::post('/books/{id}', [BookApiController::class, 'update']); 
Route::delete('/books/{id}', [BookApiController::class, 'destroy']); 

// API Hệ thống Quản lý Thể loại
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
Route::post('/categories', [CategoryApiController::class, 'store']);
Route::put('/categories/{id}', [CategoryApiController::class, 'update']);
Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy']);

// API Hệ thống Quản lý Nhà xuất bản
Route::get('/publishers', [PublisherApiController::class, 'index']);
Route::get('/publishers/{id}', [PublisherApiController::class, 'show']);
Route::post('/publishers', [PublisherApiController::class, 'store']);
Route::put('/publishers/{id}', [PublisherApiController::class, 'update']);
Route::delete('/publishers/{id}', [PublisherApiController::class, 'destroy']);