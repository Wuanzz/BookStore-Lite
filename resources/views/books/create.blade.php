<!DOCTYPE html>
<html>
<head><title>Thêm Sách</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Thêm Sách Mới</h2>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <p>Tên sách: <input type="text" name="title" required></p>
        <p>Giá tiền: <input type="number" name="price" required></p>
        <p>Thể loại: 
            <select name="category_id" required>
                <option value="">-- Chọn --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </p>
        <button type="submit">Lưu lại</button>
        <a href="{{ route('books.index') }}">Hủy</a>
    </form>
</body>
</html>