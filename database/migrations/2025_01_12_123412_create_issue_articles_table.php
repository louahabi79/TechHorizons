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
        Schema::create('issue_articles', function (Blueprint $table) {
            $table->id('issue_article_id');
            $table->unsignedBigInteger('issue_id');
            $table->unsignedBigInteger('article_id');
            $table->foreign('issue_id')->references('issue_id')->on('issues');
            $table->foreign('article_id')->references('article_id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_articles');
    }
};
