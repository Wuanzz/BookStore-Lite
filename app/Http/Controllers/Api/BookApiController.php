<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    // API GET: Lấy danh sách toàn bộ sách (Kèm thông tin thể loại)
    public function index()
    {
        $books = Book::with('category')->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy dữ liệu thành công',
            'data' => $books
        ], 200); // 200 là mã HTTP trạng thái thành công
    }

    // API POST: Thêm một cuốn sách mới từ ứng dụng bên ngoài
    public function store(Request $request)
    {
        // Yêu cầu dữ liệu gửi lên phải hợp lệ
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sách mới qua API!',
            'data' => $book
        ], 201); // 201 là mã HTTP trạng thái Đã tạo (Created)
    }
}