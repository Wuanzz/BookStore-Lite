<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Cho phép thêm dữ liệu vào các cột này
    protected $fillable = ['name'];

    // 1 Thể loại có nhiều Sách
    public function books() {
        return $this->hasMany(Book::class);
    }
}