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
        Schema::create('keycaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // Khóa ngoại liên kết đến bảng products, onDelete('cascade') để xóa keycap khi product bị xóa
            $table->string('material')->nullable(); // Chất liệu keycap (PBT, ABS, ...)
            $table->string('profile')->nullable(); // Profile keycap (Cherry, OEM, ...)
            $table->string('layout')->nullable(); // Layout hỗ trợ (ANSI, ISO, ...)
            $table->string('manufacturer')->nullable(); // Nhà sản xuất
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keycaps');
    }
};
