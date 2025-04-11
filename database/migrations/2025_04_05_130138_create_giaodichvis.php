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
        Schema::create('giaodichvis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vi_id');
            $table->string('ma_giao_dich')->nullable();
            $table->decimal('so_tien', 15, 2);
            $table->string('loai'); // 'hoan_tien', 'thanh_toan', 'nap_tien'
            $table->boolean('trang_thai')->default(1);
            $table->string('mo_ta')->nullable();
            $table->string('ten_ngan_hang')->nullable();
            $table->string('so_tai_khoan')->nullable();
            $table->string('ten_nguoi_nhan')->nullable();

            $table->timestamps();
            $table->foreign('vi_id')->references('id')->on('vis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giaodichvis');
    }
};
