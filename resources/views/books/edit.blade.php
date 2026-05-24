@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h4 class="mb-0 fw-bold">Chỉnh Sửa Sách</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên sách:</label>
                        <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                    </div>

                    <!-- Hiển thị ảnh hiện tại và cho phép chọn ảnh mới -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ảnh bìa hiện tại:</label>
                        <div class="mb-2">
                            @if($book->cover_image)
                                <img id="current_image" src="{{ asset('storage/' . $book->cover_image) }}" alt="Bìa sách" class="img-thumbnail shadow-sm" style="max-height: 150px;">
                            @else
                                <span class="text-muted fst-italic">Chưa có ảnh</span>
                                <img id="current_image" src="" class="img-thumbnail shadow-sm" style="max-height: 150px; display: none;">
                            @endif
                        </div>
                        <label class="form-label fw-semibold mt-2">Cập nhật ảnh mới:</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thể loại:</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nhà xuất bản:</label>
                            <select name="publisher_id" class="form-select">
                                <option value="">-- Chưa cập nhật --</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Giá tiền (VNĐ):</label>
                        <input type="number" name="price" class="form-control" value="{{ $book->price }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary px-4">⬅ Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-4">🔄 Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('cover_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const currentImage = document.getElementById('current_image');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentImage.src = e.target.result;
                currentImage.style.display = 'inline-block';
                
                // Ẩn dòng chữ "Chưa có ảnh" nếu trước đó sách chưa có bìa
                const emptyText = currentImage.previousElementSibling;
                if (emptyText && emptyText.tagName === 'SPAN') {
                    emptyText.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection