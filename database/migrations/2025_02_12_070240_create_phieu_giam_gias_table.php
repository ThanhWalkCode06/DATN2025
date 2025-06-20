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
        Schema::create('phieu_giam_gias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('danh_muc_id')->nullable();
            $table->string('ma_phieu')->unique();
            $table->string('ten_phieu');
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_ket_thuc')->nullable();
            $table->enum('kieu_giam', ['co_dinh','phan_tram'])->nullable();
            $table->double('gia_tri')->default(0);
            $table->double('muc_giam_toi_da')->default(0);
            $table->double('muc_gia_toi_thieu')->default(0);
            $table->unsignedInteger('so_luong')->default(0);
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_san_phams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_giam_gias');
    }
};
