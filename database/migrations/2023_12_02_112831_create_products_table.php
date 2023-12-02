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
        Schema::create('products', function (Blueprint $table) {
            // ID Sản phẩm
            $table->id();
            // ID Danh mục
            $table->integer('category_id')->default(0);
            // Mã định danh sản phẩm duy nhất
            $table->string('sku')->nullable();
            // Tên sản phẩm
            $table->string('name');
            // Đường dẫn
            $table->string('slug')->unique();
            // Ảnh sản phẩm
            $table->text('image')->nullable();
            // Giá bán
            $table->integer('price')->nullable();
            // Giá thị trường
            $table->integer('price_old')->nullable();
            // Nội dung giới thiệu sản phẩm (Editor hoặc cấu hình json)
            $table->longtext('detail')->nullable();
            //bảo hành
            $table->string('insurance')->nullable();
            //video
            $table->text('video')->nullable();
            // Số lượng sp trong kho
            $table->integer('quantity')->nullable();
            // số lượng đã bán
            $table->integer('quantity_used')->default(0);
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
        Schema::dropIfExists('products');
    }
};
