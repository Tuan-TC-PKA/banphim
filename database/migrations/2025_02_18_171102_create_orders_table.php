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
                $table->foreignId('user_id')->constrained(); // Liên kết với bảng users
                $table->timestamp('order_date')->useCurrent();
                $table->decimal('total_amount', 10, 2);
                $table->string('status')->default('pending'); // Ví dụ: 'pending', 'processing', 'shipped', 'completed', 'cancelled'
                $table->text('address')->nullable(); // Địa chỉ giao hàng và thanh toán chung
                $table->string('phone_number')->nullable(); // Số điện thoại liên hệ
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
