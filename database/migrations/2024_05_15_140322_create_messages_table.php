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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id_messages');
            $table->bigInteger('from')->unsigned();
            $table->bigInteger('to')->unsigned();
            $table->text('content');
            $table->string('chat_id');
            $table->foreign('from')->references('id_users')->on('users')->onDelete('cascade');
            $table->foreign('to')->references('id_users')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
