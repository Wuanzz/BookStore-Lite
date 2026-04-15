<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Các Route API cho Sách
Route::get('/books', [BookApiController::class, 'index']); // Lấy danh sách sách
Route::post('/books', [BookApiController::class, 'store']); // Thêm sách mới

// Các Route API cho Thể loại
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::post('/categories', [CategoryApiController::class, 'store']);