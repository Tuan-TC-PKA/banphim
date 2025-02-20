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
        Schema::create('keyboard_switches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // Khóa ngoại liên kết đến bảng products, onDelete('cascade')
            $table->string('type')->nullable(); // Loại switch (Linear, Tactile, Clicky)
            $table->string('manufacturer')->nullable(); // Nhà sản xuất
            $table->integer('actuation_force')->nullable(); // Lực nhấn kích hoạt (g)
            $table->integer('bottom_out_force')->nullable(); // Lực nhấn đáy (g)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyboard_switches');
    }
};
