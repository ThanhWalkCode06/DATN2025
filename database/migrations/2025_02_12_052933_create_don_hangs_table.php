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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('ten_nguoi_nhan');
            $table->string('email_nguoi_nhan');
            $table->string('sdt_nguoi_nhan');
            $table->text('dia_chi_nguoi_nhan');
            $table->double('tong_tien')->default(0);
            $table->text('ghi_chu')->default("Không");
            $table->text('ly_do')->nullable();
            $table->unsignedBigInteger('phuong_thuc_thanh_toan_id');
            $table->tinyInteger('trang_thai_don_hang')->default(0);
            $table->boolean('trang_thai_thanh_toan')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
