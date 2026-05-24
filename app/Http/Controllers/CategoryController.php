<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query thay vì lấy toàn bộ ngay lập tức
        $query = Category::query();

        // Kiểm tra xem người dùng có nhập từ khóa tìm kiếm không
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            // Tìm kiếm tương đối theo tên hoặc mô tả
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
        }

        // Thực thi query và lấy kết quả
        $categories = $query->get();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Thêm thể loại thành công!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Đã xóa thể loại!');
    }
}