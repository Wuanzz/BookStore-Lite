@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0 fw-bold">Thêm Nhà xuất bản Mới</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('publishers.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên NXB:</label>
                        <input type="text" name="name" class="form-control" placeholder="VD: NXB Trẻ..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Số điện thoại:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại...">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('publishers.index') }}" class="btn btn-secondary px-4">⬅ Quay lại</a>
                        <button type="submit" class="btn btn-success px-4">💾 Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection