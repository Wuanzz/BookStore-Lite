<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập Quản trị</title>
</head>
<body style="font-family: Arial; background-color: #f4f4f4; text-align: center; padding-top: 100px;">

    <div style="background: white; width: 320px; margin: auto; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">Đăng Nhập Quản Trị</h2>

        @if($errors->any())
            <p style="color: red; font-size: 14px;">{{ $errors->first() }}</p>
        @endif

        <form action="/login" method="POST">
            @csrf <p>
                <input type="email" name="email" placeholder="Email (admin@gmail.com)" required style="width: 90%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </p>
            <p>
                <input type="password" name="password" placeholder="Mật khẩu (123456)" required style="width: 90%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </p>
            <button type="submit" style="width: 96%; padding: 10px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                Đăng nhập
            </button>
        </form>
    </div>

</body>
</html>