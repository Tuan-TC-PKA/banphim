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
        Schema::create('keyboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // Khóa ngoại liên kết đến bảng products, onDelete('cascade')
            $table->string('layout')->nullable(); // Layout bàn phím (60%, TKL, Fullsize, ...)
            $table->string('case_material')->nullable(); // Chất liệu case
            $table->string('pcb_type')->nullable(); // Loại PCB (Hot-swap, Soldered)
            $table->string('manufacturer')->nullable(); // Nhà sản xuất
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyboards');
    }
};
