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
        Schema::table('vai_tro_tai_khoans', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vai_tro_id')->references('id')->on('vai_tros');
        });

        Schema::table('quyen_vai_tros', function (Blueprint $table) {
            $table->foreign('quyen_id')->references('id')->on('quyens');
            $table->foreign('vai_tro_id')->references('id')->on('vai_tros');
        });

        Schema::table('san_phams', function (Blueprint $table) {
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_san_phams');
        });

        Schema::table('anh_san_phams', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
        });

        Schema::table('bien_thes', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
            $table->foreign('thuoc_tinh_id')->references('id')->on('thuoc_tinhs');
            $table->foreign('gia_tri_thuoc_tinh_id')->references('id')->on('gia_tri_thuoc_tinhs');
        });

        Schema::table('gia_tri_thuoc_tinhs', function (Blueprint $table) {
            $table->foreign('thuoc_tinh_id')->references('id')->on('thuoc_tinhs');
        });

        Schema::table('san_pham_yeu_thichs', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('chi_tiet_phieu_giam_gias', function (Blueprint $table) {
            $table->foreign('phieu_giam_gia_id')->references('id')->on('phieu_giam_gias');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('danh_gias', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_phams');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('gio_hangs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('chi_tiet_gio_hangs', function (Blueprint $table) {
            $table->foreign('gio_hang_id')->references('id')->on('gio_hangs');
            $table->foreign('bien_the_id')->references('id')->on('bien_thes');
        });

        Schema::table('don_hangs', function (Blueprint $table) {
            $table->foreign('phuong_thuc_thanh_toan_id')->references('id')->on('phuong_thuc_thanh_toans');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->foreign('don_hang_id')->references('id')->on('don_hangs');
            $table->foreign('bien_the_id')->references('id')->on('bien_thes');
        });

        Schema::table('bai_viets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_bai_viets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vai_tro_tai_khoans', function (Blueprint $table) {
            $table->dropForeign('vai_tro_tai_khoans_user_id_foreign');
            $table->dropForeign('vai_tro_tai_khoans_vai_tro_id_foreign');
        });

        Schema::table('quyen_vai_tros', function (Blueprint $table) {
            $table->dropForeign('quyen_vai_tros_quyen_id_foreign');
            $table->dropForeign('quyen_vai_tros_vai_tro_id_foreign');
        });

        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropForeign('san_phams_danh_muc_id_foreign');
        });

        Schema::table('anh_san_phams', function (Blueprint $table) {
            $table->dropForeign('anh_san_phams_san_pham_id_foreign');
        });

        Schema::table('bien_thes', function (Blueprint $table) {
            $table->dropForeign('bien_thes_san_pham_id_foreign');
            $table->dropForeign('bien_thes_thuoc_tinh_id_foreign');
            $table->dropForeign('bien_thes_gia_tri_thuoc_tinh_id_foreign');
        });

        Schema::table('gia_tri_thuoc_tinhs', function (Blueprint $table) {
            $table->dropForeign('gia_tri_thuoc_tinhs_thuoc_tinh_id_foreign');
        });

        Schema::table('san_pham_yeu_thichs', function (Blueprint $table) {
            $table->dropForeign('san_pham_yeu_thichs_san_pham_id_foreign');
            $table->dropForeign('san_pham_yeu_thichs_user_id_foreign');
        });

        Schema::table('chi_tiet_phieu_giam_gias', function (Blueprint $table) {
            $table->dropForeign('chi_tiet_phieu_giam_gias_phieu_giam_gia_id_foreign');
            $table->dropForeign('chi_tiet_phieu_giam_gias_user_id_foreign');
        });

        Schema::table('danh_gias', function (Blueprint $table) {
            $table->dropForeign('danh_gias_san_pham_id_foreign');
            $table->dropForeign('danh_gias_user_id_foreign');
        });

        Schema::table('gio_hangs', function (Blueprint $table) {
            $table->dropForeign('gio_hangs_user_id_foreign');
        });

        Schema::table('chi_tiet_gio_hangs', function (Blueprint $table) {
            $table->dropForeign('chi_tiet_gio_hangs_gio_hang_id_foreign');
            $table->dropForeign('chi_tiet_gio_hangs_bien_the_id_foreign');
        });

        Schema::table('don_hangs', function (Blueprint $table) {
            $table->dropForeign('don_hangs_phuong_thuc_thanh_toan_id_foreign');
            $table->dropForeign('don_hangs_user_id_foreign');
        });

        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->dropForeign('chi_tiet_don_hangs_don_hang_id_foreign');
            $table->dropForeign('chi_tiet_don_hangs_bien_the_id_foreign');
        });

        Schema::table('bai_viets', function (Blueprint $table) {
            $table->dropForeign('bai_viets_user_id_foreign');
            $table->dropForeign('bai_viets_danh_muc_id_foreign');
        });
    }
};
