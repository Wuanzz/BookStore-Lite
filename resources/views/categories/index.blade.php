<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Thể loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4 px-3">
        <div class="container-fluid">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-link active fw-bold text-primary fs-5" href="{{ route('categories.index') }}">📑 Quản lý Thể loại</a>
                <a class="nav-link fw-bold fs-5" href="{{ route('books.index') }}">📚 Quản lý Sách</a>
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

    <h2 class="mb-4 text-secondary fw-bold">Danh sách Thể loại</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">+ Thêm Thể loại Mới</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3" style="width: 10%;">ID</th>
                            <th>Tên Thể loại</th>
                            <th class="text-center" style="width: 20%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="px-3 fw-bold">{{ $category->id }}</td>
                            <td><span class="badge bg-info text-dark fs-6">{{ $category->name }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Cậu có chắc chắn muốn xóa thể loại này không? (Lưu ý: Các sách thuộc thể loại này cũng sẽ bị xóa theo)')">Xóa</button>
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