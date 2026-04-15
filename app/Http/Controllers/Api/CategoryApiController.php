<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    // API GET: Lấy danh sách thể loại
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }

    // API POST: Thêm thể loại mới
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm thể loại qua API!',
            'data' => $category
        ], 201);
    }
}