<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sách Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Thêm Sách Mới</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên sách:</label>
                            <input type="text" name="title" class="form-control" placeholder="Nhập tên tựa sách..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Giá tiền (VNĐ):</label>
                            <input type="number" name="price" class="form-control" placeholder="VD: 150000" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Thể loại:</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Chọn thể loại sách --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
</div>

</body>
</html>