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
        Schema::create('product_categories', function (Blueprint $table) {
            // ID
            $table->id();
            // ID danh mục cha
            $table->integer('parent_id')->default(0);
            // Tên
            $table->string('name');
            // Đường dẫn
            $table->string('slug')->unique();
            // Ảnh
            $table->text('image')->nullable();
             // Ảnh icon hiển thị tại menu
            $table->text('icon')->nullable(); 
            // Nội dung
            $table->longtext('detail')->nullable();
            // Sắp xếp
            $table->integer('order')->default(99999);
            // Trạng thái (-1 Xóa | 0 Không hoạt động | 1 Hoạt động)
            $table->tinyInteger('status')->default(1);
            // Ngày đăng/cập nhật
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
