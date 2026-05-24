@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-secondary fw-bold">Danh sách Thể loại</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">+ Thêm Thể loại Mới</a>
        </div>
        
        <div>
            <form action="{{ route('categories.index') }}" method="GET" class="d-flex flex-nowrap gap-2 align-items-center">
                <input type="text" name="search" class="form-control shadow-sm" style="width: 250px;" placeholder="Nhập tên hoặc mô tả..." value="{{ request('search') }}">
                
                <button type="submit" class="btn btn-secondary shadow-sm px-3 text-nowrap">Tìm kiếm</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-danger shadow-sm px-3 text-nowrap">Xóa lọc</a>
            </form>
        </div>
    </div>

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
                        @forelse($categories as $category)
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
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Không tìm thấy thể loại nào phù hợp với từ khóa của cậu!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection