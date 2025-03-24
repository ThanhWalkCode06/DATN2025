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
        Schema::create('bien_the_thuoc_tinhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bien_the_id')->constrained('bien_thes')->onDelete('cascade');
            $table->foreignId('thuoc_tinh_id')->constrained('thuoc_tinhs')->onDelete('cascade');
            $table->foreignId('gia_tri_thuoc_tinh_id')->constrained('gia_tri_thuoc_tinhs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_the_thuoc_tinhs');
    }
};
