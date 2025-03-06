<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('phieu_giam_gias', function (Blueprint $table) {
            $table->boolean('trang_thai')->default(1)->after('gia_tri');
        });
    }
    
    public function down()
    {
        Schema::table('phieu_giam_gias', function (Blueprint $table) {
            $table->dropColumn('trang_thai');
        });
    }
    };
