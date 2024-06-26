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
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id_articles');
            $table->string('title');
            $table->string('image');
            $table->text('content');
            $table->bigInteger('creator_id')->unsigned();
            $table->timestamps();
            $table->foreign('creator_id')->references('id_psychologists')->on('psychologists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
