<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Gọi đúng tên thư mục profiles có s của cậu
        return view('profiles.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Kiểm tra dữ liệu và tự định nghĩa câu thông báo Tiếng Việt
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6|confirmed'
        ], [
            'name.required' => 'Cậu chưa nhập họ và tên kìa.',
            'name.max' => 'Họ và tên không được dài quá 255 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã có người khác sử dụng rồi.',
            'avatar.image' => 'File tải lên bắt buộc phải là hình ảnh.',
            'avatar.mimes' => 'Hình ảnh phải có đuôi jpeg, png hoặc jpg.',
            'avatar.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Phần xác nhận mật khẩu mới không khớp nhau.'
        ]);

        // Kiểm tra bảo mật nếu có ý định đổi mật khẩu
        if ($request->filled('password')) {
            if (!$request->filled('current_password')) {
                return redirect()->back()->withErrors(['current_password' => 'Cậu bắt buộc phải nhập Mật khẩu hiện tại nếu muốn đổi mật khẩu mới!']);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại cậu nhập không chính xác!']);
            }
        }

        // Cập nhật thông tin cơ bản
        $user->name = $request->name;
        $user->email = $request->email;

        // Xử lý Avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // Tiến hành đổi mật khẩu
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profiles.index')->with('success', 'Cập nhật hồ sơ cá nhân thành công!');
    }
}