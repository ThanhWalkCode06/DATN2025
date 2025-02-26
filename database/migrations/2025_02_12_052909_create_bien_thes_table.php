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
        Schema::create('bien_thes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('san_pham_id');
            $table->unsignedBigInteger('thuoc_tinh_id');
            $table->unsignedBigInteger('gia_tri_thuoc_tinh_id');
            $table->string('ten_bien_the');
            $table->string('anh_bien_the')->default('default.png');
            $table->double('gia_nhap')->default(0);
            $table->double('gia_ban')->default(0);
            $table->integer('so_luong')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_thes');
    }
};
