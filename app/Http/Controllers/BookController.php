<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. ĐỌC & LỌC DỮ LIỆU
    public function index(Request $request)
    {
        $query = Book::with('category');

        // 1. Tìm kiếm theo tên sách
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 2. Lọc theo Thể loại (Tính năng mới)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->get();
        
        // Lấy danh sách tất cả thể loại để đưa vào menu Dropdown
        $categories = Category::all();

        // Trả về View cùng với cả biến $books và $categories
        return view('books.index', compact('books', 'categories'));
    }

    // 2. THÊM DỮ LIỆU
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'price' => 'required|numeric', 'category_id' => 'required']);
        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Thêm sách thành công!');
    }

    // 3. SỬA DỮ LIỆU
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required', 'price' => 'required|numeric', 'category_id' => 'required']);
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Cập nhật thành công!');
    }

    // 4. XÓA DỮ LIỆU
    public function destroy($id)
    {
        Book::destroy($id);
        return redirect()->route('books.index')->with('success', 'Đã xóa sách!');
    }
}