@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h4 class="mb-0 fw-bold">Chỉnh Sửa Nhà xuất bản</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên NXB:</label>
                        <input type="text" name="name" class="form-control" value="{{ $publisher->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" value="{{ $publisher->address }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Số điện thoại:</label>
                        <input type="text" name="phone" class="form-control" value="{{ $publisher->phone }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('publishers.index') }}" class="btn btn-secondary px-4">⬅ Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-4">🔄 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection