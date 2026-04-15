<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm" style="width: 380px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary fw-bold">Đăng Nhập Quản Trị</h3>

            @if($errors->any())
                <div class="alert alert-danger py-2 text-center" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf 
                <div class="mb-3">
                    <label class="form-label text-muted">Tài khoản Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="admin@gmail.com" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted">Mật khẩu</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                    Đăng nhập
                </button>
            </form>
        </div>
    </div>

</body>
</html>