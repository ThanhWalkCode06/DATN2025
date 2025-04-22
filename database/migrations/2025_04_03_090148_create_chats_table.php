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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoi_gui_id');
            $table->unsignedBigInteger('nguoi_nhan_id');
            $table->text('ten_nguoi_gui');
            $table->text('ten_nguoi_nhan');
            $table->text('noi_dung');
            $table->string('hinh_anh')->nullable();
            $table->boolean('trang_thai')->default(false);
            $table->unsignedBigInteger('channel');
            $table->timestamps();

            $table->foreign('nguoi_gui_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nguoi_nhan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
