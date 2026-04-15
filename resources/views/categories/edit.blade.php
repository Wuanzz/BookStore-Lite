<!DOCTYPE html>
<html>
<head><title>Sửa Thể loại</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Sửa Thể loại</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')
        <p>Tên Thể loại: <input type="text" name="name" value="{{ $category->name }}" required></p>
        <button type="submit">Cập nhật</button>
        <a href="{{ route('categories.index') }}">Hủy</a>
    </form>
</body>
</html>