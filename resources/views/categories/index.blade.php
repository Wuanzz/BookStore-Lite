@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-secondary fw-bold">Danh sách Thể loại</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">+ Thêm Thể loại Mới</a>
    </div>

    <!-- Bảng dữ liệu có thêm cột Mô tả -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3" style="width: 10%;">ID</th>
                            <th style="width: 25%;">Tên Thể loại</th>
                            <th>Mô tả</th>
                            <th class="text-center" style="width: 15%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="px-3 fw-bold">{{ $category->id }}</td>
                            <td><span class="badge bg-info text-dark fs-6">{{ $category->name }}</span></td>
                            <td class="text-muted">{{ $category->description ?? 'Chưa có mô tả' }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Cậu có chắc chắn muốn xóa?')">Xóa</button>
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