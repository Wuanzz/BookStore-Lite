<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    // API GET: Lấy danh sách thể loại (Có tìm kiếm theo tên hoặc mô tả)
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $categories = $query->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy danh sách thể loại thành công',
            'data' => $categories
        ], 200);
    }

    // API GET: Xem chi tiết thể loại
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy thể loại này!'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }

    // API POST: Thêm thể loại mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên thể loại không được để trống.'
        ]);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm thể loại mới qua API!',
            'data' => $category
        ], 201);
    }

    // API PUT: Cập nhật thông tin thể loại
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy thể loại cần cập nhật!'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên thể loại không được bỏ trống.'
        ]);

        $category->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật thể loại thành công!',
            'data' => $category
        ], 200);
    }

    // API DELETE: Xóa thể loại
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy thể loại cần xóa!'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa thể loại thành công!'
        ], 200);
    }
}