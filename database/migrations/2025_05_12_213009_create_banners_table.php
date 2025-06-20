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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable(); // ví dụ: homepage, sidebar
            $table->unsignedBigInteger('link_id')->nullable();
            $table->string('custom_url')->nullable();
            $table->boolean('status')->default(1);
            $table->enum('priority', [1, 2, 3])->default(1);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();


            // $table->foreign('category_id')->references('id')->on('danh_muc_san_phams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('banners', function (Blueprint $table) {
        //     $table->dropForeign('category_id');
        // });
        Schema::dropIfExists('banners');

    }
};
