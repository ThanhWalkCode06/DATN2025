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
        Schema::create('gia_tri_thuoc_tinhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thuoc_tinh_id');
            $table->unsignedBigInteger('bien_the_id');
            $table->string('gia_tri');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gia_tri_thuoc_tinhs');
    }
};
