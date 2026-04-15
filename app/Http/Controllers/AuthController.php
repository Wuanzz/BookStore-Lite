<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('login');
    }

    // 2. Xử lý khi người dùng gõ email/pass và bấm Đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auth::attempt sẽ tự động đem pass người dùng nhập đi băm và so sánh với CSDL
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Đăng nhập đúng -> Chuyển vào trang Quản lý Sách
            return redirect()->intended('/categories'); 
        }

        // Đăng nhập sai -> Quay lại form và báo lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác!',
        ]);
    }

    // 3. Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}