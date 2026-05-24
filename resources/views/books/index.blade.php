@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-secondary fw-bold">Danh sách Kho Sách</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('books.create') }}" class="btn btn-primary shadow-sm px-4 text-nowrap">+ Thêm Sách Mới</a>
        </div>
        
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

    <!-- Bảng hiển thị thông tin -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3">ID</th>
                            <th>Tên sách</th>
                            <th>Thể loại</th>
                            <th>Nhà xuất bản</th>
                            <th>Giá tiền</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="px-3 fw-bold">{{ $book->id }}</td>
                            <td class="fw-semibold">{{ $book->title }}</td>
                            <td><span class="badge bg-info text-dark">{{ $book->category->name ?? 'Không có' }}</span></td>
                            <td><span class="badge bg-success">{{ $book->publisher->name ?? 'Chưa cập nhật' }}</span></td>
                            <td class="text-danger fw-bold">{{ number_format($book->price) }} VNĐ</td>
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
@endsection