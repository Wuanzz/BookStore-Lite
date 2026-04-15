<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Cho phép thêm dữ liệu vào các cột này
    protected $fillable = ['title', 'price', 'category_id'];

    // 1 Cuốn sách thuộc về 1 Thể loại
    public function category() {
        return $this->belongsTo(Category::class);
    }
}