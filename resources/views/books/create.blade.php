@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0 fw-bold">Thêm Sách Mới</h4>
            </div>
            <div class="card-body p-4">
                <!-- Bắt buộc phải có enctype để upload file -->
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên sách:</label>
                        <input type="text" name="title" class="form-control" placeholder="Nhập tên tựa sách..." required>
                    </div>

                    <!-- Ô chọn file ảnh và vùng xem trước -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ảnh bìa:</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                        <div class="mt-3 text-center" id="preview_container" style="display: none;">
                            <img id="image_preview" src="" alt="Xem trước ảnh" class="img-thumbnail shadow-sm" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thể loại:</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Chọn thể loại --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nhà xuất bản:</label>
                            <select name="publisher_id" class="form-select">
                                <option value="">-- Chọn NXB --</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Giá tiền (VNĐ):</label>
                        <input type="number" name="price" class="form-control" placeholder="VD: 150000" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary px-4">⬅ Quay lại</a>
                        <button type="submit" class="btn btn-success px-4">💾 Lưu Sách</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script xử lý xem trước hình ảnh -->
<script>
    document.getElementById('cover_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview_container');
        const previewImage = document.getElementById('image_preview');
        
        if (file) {
            previewContainer.style.display = 'block';
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            previewImage.src = '';
        }
    });
</script>
@endsection