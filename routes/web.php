<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Gõ localhost:8000 sẽ tự động đẩy sang trang login
Route::get('/', function () {
    return redirect('/login');
});

// Các Route cho hệ thống Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');