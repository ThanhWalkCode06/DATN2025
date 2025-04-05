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
            $table->decimal('so_tien', 15, 2);
            $table->string('loai'); // 'hoan_tien', 'thanh_toan', 'nap_tien'
            $table->string('mo_ta')->nullable();
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
