<!DOCTYPE html>
<html>
<head><title>Quản lý Sách</title></head>
<body style="font-family: Arial; padding: 20px;">

    <div style="background: #eee; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <a href="{{ route('books.index') }}" style="margin-right: 20px; font-weight: bold; text-decoration: none; color: blue;">📚 Quản lý Sách</a>
            <a href="{{ route('categories.index') }}" style="font-weight: bold; text-decoration: none; color: black;">📑 Quản lý Thể loại</a>
        </div>
        <div>
            <b>Xin chào, {{ Auth::user()->name }}</b>
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 10px;">
                @csrf <button type="submit">Đăng xuất</button>
            </form>
        </div>
    </div>

    <h2>Danh sách Kho Sách</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('books.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Nhập tên sách..." value="{{ request('search') }}">
        <button type="submit">Lọc dữ liệu</button>
    </form>

    <a href="{{ route('books.create') }}"><button style="background: blue; color: white;">+ Thêm Sách Mới</button></a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <tr style="background: #ddd;">
            <th>ID</th><th>Tên sách</th><th>Thể loại</th><th>Giá tiền</th><th>Hành động</th>
        </tr>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->category->name ?? 'Không có' }}</td>
            <td>{{ number_format($book->price) }} VNĐ</td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}"><button>Sửa</button></a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>