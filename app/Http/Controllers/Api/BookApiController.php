<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookApiController extends Controller
{
    // API GET: Lấy danh sách sách (Hỗ trợ tìm kiếm, lọc thể loại, kèm Category và Publisher)
    public function index(Request $request)
    {
        $query = Book::with(['category', 'publisher']);

        // Xử lý tìm kiếm theo tên sách
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Xử lý lọc theo thể loại
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->get();

        // Biến đổi đường dẫn ảnh thành link URL chạy được trực tiếp
        $books->transform(function ($book) {
            if ($book->cover_image) {
                $book->cover_image = asset('storage/' . $book->cover_image);
            }
            return $book;
        });
        
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy danh sách sách thành công',
            'data' => $books
        ], 200);
    }

    // API GET: Xem chi tiết một cuốn sách
    public function show($id)
    {
        $book = Book::with(['category', 'publisher'])->find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy cuốn sách này trong kho!'
            ], 404);
        }

        if ($book->cover_image) {
            $book->cover_image = asset('storage/' . $book->cover_image);
        }

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 200);
    }

    // API POST: Thêm sách mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'title.required' => 'Tên sách không được để trống.',
            'price.numeric' => 'Giá tiền phải là định dạng số.',
            'category_id.exists' => 'Thể loại được chọn không tồn tại.',
            'publisher_id.exists' => 'Nhà xuất bản được chọn không tồn tại.'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Book::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sách mới thành công qua API!',
            'data' => $book
        ], 201);
    }

    // API POST (PUT/PATCH): Cập nhật thông tin sách
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy cuốn sách cần chỉnh sửa!'
            ], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ đi nếu có để tránh đầy ổ cứng
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật thông tin sách thành công!',
            'data' => $book
        ], 200);
    }

    // API DELETE: Xóa sách (Dọn sạch cả file ảnh đính kèm)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy cuốn sách cần xóa!'
            ], 404);
        }

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa sách khỏi hệ thống thông qua API!'
        ], 200);
    }
}