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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // ID khách hàng
            $table->integer('customer_id');
            // Mã đơn hàng
            $table->string('code')->nullable();
            // Tổng giá của đơn
            $table->integer('total_price')->default(0);
            // Ghi chú tại đơn
            $table->text('note')->nullable();
            // Trạng thái đơn (1 Đơn hàng mới | 2 Đã tiếp nhận | 3 Chờ xử lý | 4 Huỷ | 5 Thành công)
            $table->tinyInteger('status')->default(1);
            // Ngày tạo, cập nhật
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
