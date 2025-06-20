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
        Schema::create('banner_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id');
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('descript')->nullable();
            $table->string('image_url'); // đường dẫn ảnh
            $table->enum('link_type', ['sanpham', 'danhmuc', 'tuychinh'])->nullable();
            $table->string('caption')->nullable(); // mô tả ảnh (nếu cần)
            $table->integer('sort_order')->default(0); // thứ tự hiển thị
            $table->string('link_url')->nullable(); // ảnh có thể gán link riêng
            $table->boolean('status_button')->default(1);
            $table->string('content_button')->nullable();
            $table->timestamps();
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_images');
    }
};
