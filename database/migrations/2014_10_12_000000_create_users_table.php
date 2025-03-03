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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('ten_nguoi_dung')->nullable();
            $table->boolean('gioi_tinh')->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('so_dien_thoai')->unique();
            $table->string('dia_chi')->nullable();
            $table->boolean('trang_thai')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
