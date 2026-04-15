<!DOCTYPE html>
<html>
<head><title>Thêm Thể loại</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Thêm Thể loại Mới</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <p>Tên Thể loại: <input type="text" name="name" required></p>
        <button type="submit">Lưu lại</button>
        <a href="{{ route('categories.index') }}">Hủy</a>
    </form>
</body>
</html>