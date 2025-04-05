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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('mail_mailer')->default('smtp');
            $table->string('mail_host')->default('smtp.gmail.com');
            $table->integer('mail_port')->default(587);
            $table->string('mail_username')->nullable();
            $table->text('mail_password')->nullable();
            $table->string('mail_encryption')->default('tls');
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('name_website')->nullable();
            $table->string('url_map', 500)->default('https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+Cao+%C4%91%E1%BA%B3ng+FPT+Polytechnic/@21.0381298,105.7472618,17z/data=!4m6!3m5!1s0x313455e940879933:0xcf10b34e9f1a03df!8m2!3d21.0381298!4d105.7472618!16s%2Fg%2F11krd97y__?entry=ttu&g_ep=EgoyMDI1MDQwMi4xIKXMDSoASAFQAw%3D%3D');
            $table->string('location')->default('Tòa nhà FPT Polytechnic');
            $table->string('email_owner')->default('thanhchillchill@gmail.com');
            $table->string('phone')->default('0387660612');
            $table->string('logo')->default('images/logo.png');
            $table->string('client_logo')->default('images/logo-green.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
