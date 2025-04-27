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
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('san_pham_id');
            $table->unsignedBigInteger('bien_the_id')->nullable(); 
            $table->unsignedBigInteger('don_hang_id')->nullable();// Thêm dòng này
            $table->tinyInteger('so_sao');
            $table->text('nhan_xet')->nullable();
            $table->json('hinh_anh_danh_gia')->nullable();
            $table->string('video')->nullable();
            $table->boolean('trang_thai')->default(1);
            $table->text('ly_do_an')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bien_the_id')->references('id')->on('bien_thes')->onDelete('cascade'); // Thêm dòng này
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
