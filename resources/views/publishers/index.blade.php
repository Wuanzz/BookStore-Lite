@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-secondary fw-bold">Danh sách Nhà xuất bản</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('publishers.create') }}" class="btn btn-primary shadow-sm">+ Thêm NXB Mới</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3" style="width: 10%;">ID</th>
                            <th style="width: 25%;">Tên NXB</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th class="text-center" style="width: 15%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publishers as $publisher)
                        <tr>
                            <td class="px-3 fw-bold">{{ $publisher->id }}</td>
                            <td><span class="badge bg-success fs-6">{{ $publisher->name }}</span></td>
                            <td class="text-muted">{{ $publisher->address ?? 'Chưa cập nhật' }}</td>
                            <td class="text-muted">{{ $publisher->phone ?? 'Chưa cập nhật' }}</td>
                            <td class="text-center">
                                <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" style="display:inline;">
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