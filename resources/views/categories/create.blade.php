@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0 fw-bold">Thêm Thể loại Mới</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên Thể loại:</label>
                        <input type="text" name="name" class="form-control" placeholder="VD: Kinh tế..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mô tả (Không bắt buộc):</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Nhập mô tả chi tiết cho thể loại này..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">⬅ Quay lại</a>
                        <button type="submit" class="btn btn-success px-4">💾 Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection