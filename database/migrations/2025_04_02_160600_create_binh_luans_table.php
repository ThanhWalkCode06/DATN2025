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
        Schema::create('binh_luans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('bai_viet_id')->constrained('bai_viets')->onDelete('cascade'); // Liên kết bài viết
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết người dùng
                $table->foreignId('parent_id')->nullable()->constrained('binh_luans')->onDelete('cascade'); // Bình luận cha
                $table->text('noi_dung');
                $table->boolean('trang_thai')->default(1);
                $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luans');
    }
};
