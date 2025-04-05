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
        Schema::create('vis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nguoi_dung_id'); // user_id
            $table->decimal('so_du', 15, 2)->default(0); // balance
            $table->timestamps();
            $table->foreign('nguoi_dung_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vis');
    }
};
