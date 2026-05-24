<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher; // KHAI BÁO MODEL NHÀ XUẤT BẢN
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Bổ sung 'publisher' vào hàm with() để lấy dữ liệu liên kết
        $query = Book::with(['category', 'publisher']);

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->get();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all(); // Lấy danh sách NXB
        return view('books.create', compact('categories', 'publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Thêm sách mới thành công!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $publishers = Publisher::all(); // Lấy danh sách NXB
        return view('books.edit', compact('book', 'categories', 'publishers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return redirect()->route('books.index')->with('success', 'Đã xóa sách khỏi hệ thống!');
    }
}