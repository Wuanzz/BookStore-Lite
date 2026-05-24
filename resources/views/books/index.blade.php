<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4 px-3">
        <div class="container-fluid">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-link fw-bold fs-5" href="{{ route('categories.index') }}">📑 Quản lý Thể loại</a>
                <a class="nav-link active fw-bold text-primary fs-5" href="{{ route('books.index') }}">📚 Quản lý Sách</a>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 fw-semibold">Xin chào, <span class="text-success">{{ Auth::user()->name }}</span></span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf 
                    <button type="submit" class="btn btn-outline-danger btn-sm">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>

    <h2 class="mb-4 text-secondary fw-bold">Danh sách Kho Sách</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <!-- Nút thêm sách -->
        <div>
            <a href="{{ route('books.create') }}" class="btn btn-primary shadow-sm px-4 text-nowrap">
                + Thêm Sách Mới
            </a>
        </div>
        
        <!-- Form Tìm kiếm & Lọc (Đã ép nằm trên 1 hàng ngang) -->
        <div>
            <form action="{{ route('books.index') }}" method="GET" class="d-flex flex-nowrap gap-2 align-items-center">
                
                <input type="text" name="search" class="form-control shadow-sm" style="width: 220px;" placeholder="Nhập tên sách..." value="{{ request('search') }}">
                
                <select name="category_id" class="form-select shadow-sm" style="width: 200px;">
                    <option value="">-- Tất cả Thể loại --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-secondary shadow-sm px-3 text-nowrap">Lọc</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline-danger shadow-sm px-3 text-nowrap">Xóa lọc</a>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3">ID</th>
                            <th>Tên sách</th>
                            <th>Thể loại</th>
                            <th>Giá tiền</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="px-3 fw-bold">{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td><span class="badge bg-info text-dark">{{ $book->category->name ?? 'Không có' }}</span></td>
                            <td class="text-danger fw-semibold">{{ number_format($book->price) }} VNĐ</td>
                            <td class="text-center">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Cậu có chắc chắn muốn xóa cuốn sách này không?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>