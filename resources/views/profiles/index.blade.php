@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0 fw-bold">Hồ Sơ Cá Nhân</h4>
            </div>
            <div class="card-body p-5">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Khu vực Đổi Avatar -->
                    <div class="text-center mb-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #0d6efd;">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center mx-auto shadow" style="width: 120px; height: 120px; font-size: 3rem;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="mt-3">
                            <label class="form-label fw-semibold text-muted">Đổi ảnh đại diện (Không bắt buộc)</label>
                            <input type="file" name="avatar" class="form-control form-control-sm mx-auto @error('avatar') is-invalid @enderror" style="max-width: 300px;" accept="image/*">
                            @error('avatar')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="mb-4">

                    <!-- Khu vực Thông tin cơ bản -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Họ và Tên:</label>
                        <input type="text" name="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Email (Dùng để đăng nhập):</label>
                        <input type="email" name="email" class="form-control bg-light @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="mb-4">
                    <h6 class="text-danger fw-bold mb-3">ĐỔI MẬT KHẨU</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Mật khẩu hiện tại:</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Nhập mật khẩu hiện tại để xác minh danh tính">
                        @error('current_password')
                            <div class="invalid-feedback fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Mật khẩu mới:</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ít nhất 6 ký tự">
                            @error('password')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-semibold">Xác nhận mật khẩu mới:</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </div>

                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">💾 Cập nhật Hồ sơ</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection