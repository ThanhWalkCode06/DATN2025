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
        Schema::create('chi_tiet_phieu_giam_gias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phieu_giam_gia_id');
            $table->unsignedBigInteger('user_id');
            $table->text('mo_ta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_phieu_giam_gias');
    }
};
