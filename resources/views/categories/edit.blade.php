@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h4 class="mb-0 fw-bold">Chỉnh Sửa Thể loại</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên Thể loại:</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mô tả:</label>
                        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">⬅ Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-4">🔄 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection