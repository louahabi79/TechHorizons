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
        Schema::create('theme_responsibles', function (Blueprint $table) {
            $table->id('theme_responsible_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('theme_id')->references('theme_id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_responsibles');
    }
};
