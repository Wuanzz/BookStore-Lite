<?php
namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $query = Publisher::query();

        // Tìm kiếm theo tên, địa chỉ hoặc số điện thoại
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('address', 'like', '%' . $keyword . '%')
                  ->orWhere('phone', 'like', '%' . $keyword . '%');
        }

        $publishers = $query->get();
        return view('publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Publisher::create($request->all());
        return redirect()->route('publishers.index')->with('success', 'Thêm Nhà xuất bản thành công!');
    }

    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('publishers.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $publisher = Publisher::findOrFail($id);
        $publisher->update($request->all());
        return redirect()->route('publishers.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Publisher::destroy($id);
        return redirect()->route('publishers.index')->with('success', 'Đã xóa Nhà xuất bản!');
    }
}