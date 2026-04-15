<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark text-center py-3">
                    <h4 class="mb-0 fw-bold">Chỉnh Sửa Sách</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf 
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sách:</label>
                            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá tiền (VNĐ):</label>
                            <input type="number" name="price" class="form-control" value="{{ $book->price }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Thể loại:</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
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
</div>

</body>
</html>