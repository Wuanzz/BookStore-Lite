<!DOCTYPE html>
<html>
<head><title>Sửa Sách</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Sửa Sách</h2>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf @method('PUT')
        <p>Tên sách: <input type="text" name="title" value="{{ $book->title }}" required></p>
        <p>Giá tiền: <input type="number" name="price" value="{{ $book->price }}" required></p>
        <p>Thể loại: 
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <button type="submit">Cập nhật</button>
        <a href="{{ route('books.index') }}">Hủy</a>
    </form>
</body>
</html>