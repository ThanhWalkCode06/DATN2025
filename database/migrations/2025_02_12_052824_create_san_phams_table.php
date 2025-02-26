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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->string('ma_san_pham');
            $table->double('khuyen_mai')->default(0);
<<<<<<< HEAD
            $table->string('hinh_anh')->nullable();
=======
            $table->string('hinh_anh')->default('default.png');
>>>>>>> 0c37ef05cc633316008540523e4656e9f80097a8
            $table->text('mo_ta')->nullable();
            $table->unsignedBigInteger('danh_muc_id');
            $table->boolean('trang_thai')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
