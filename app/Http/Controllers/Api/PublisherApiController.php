<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherApiController extends Controller
{
    // API GET: Lấy danh sách nhà xuất bản (Tìm kiếm theo Tên, Địa chỉ, SĐT)
    public function index(Request $request)
    {
        $query = Publisher::query();

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('address', 'like', '%' . $keyword . '%')
                  ->orWhere('phone', 'like', '%' . $keyword . '%');
        }

        $publishers = $query->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Lấy danh sách nhà xuất bản thành công',
            'data' => $publishers
        ], 200);
    }

    // API GET: Xem chi tiết nhà xuất bản
    public function show($id)
    {
        $publisher = Publisher::find($id);

        if (!$publisher) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy nhà xuất bản này!'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $publisher
        ], 200);
    }

    // API POST: Thêm nhà xuất bản mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên nhà xuất bản không được để trống.'
        ]);

        $publisher = Publisher::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm nhà xuất bản thành công qua API!',
            'data' => $publisher
        ], 201);
    }

    // API PUT: Cập nhật nhà xuất bản
    public function update(Request $request, $id)
    {
        $publisher = Publisher::find($id);

        if (!$publisher) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy nhà xuất bản cần cập nhật!'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên nhà xuất bản không được trống.'
        ]);

        $publisher->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật nhà xuất bản thành công!',
            'data' => $publisher
        ], 200);
    }

    // API DELETE: Xóa nhà xuất bản
    public function destroy($id)
    {
        $publisher = Publisher::find($id);

        if (!$publisher) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy nhà xuất bản cần xóa!'
            ], 404);
        }

        $publisher->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa nhà xuất bản thành công!'
        ], 200);
    }
}