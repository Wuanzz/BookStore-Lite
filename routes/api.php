<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Các Route API cho Cửa hàng sách
Route::get('/books', [BookApiController::class, 'index']); // Lấy danh sách sách
Route::post('/books', [BookApiController::class, 'store']); // Thêm sách mới