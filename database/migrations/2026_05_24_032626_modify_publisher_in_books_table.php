<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Xóa cột publisher cũ
            $table->dropColumn('publisher');
            // Thêm cột khóa ngoại publisher_id mới
            $table->unsignedBigInteger('publisher_id')->nullable()->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('publisher_id');
            $table->string('publisher')->nullable();
        });
    }
};
