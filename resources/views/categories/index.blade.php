<!DOCTYPE html>
<html>
<head><title>Quản lý Thể loại</title></head>
<body style="font-family: Arial; padding: 20px;">

    <div style="background: #eee; padding: 10px; margin-bottom: 20px;">
        <a href="{{ route('books.index') }}" style="margin-right: 20px; font-weight: bold; text-decoration: none; color: black;">📚 Quản lý Sách</a>
        <a href="{{ route('categories.index') }}" style="font-weight: bold; text-decoration: none; color: blue;">📑 Quản lý Thể loại</a>
    </div>

    <h2>Danh sách Thể loại</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('categories.create') }}"><button style="background: blue; color: white; margin-bottom: 20px;">+ Thêm Thể loại</button></a>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 50%; text-align: left;">
        <tr style="background: #ddd;">
            <th>ID</th><th>Tên Thể loại</th><th>Hành động</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}"><button>Sửa</button></a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>