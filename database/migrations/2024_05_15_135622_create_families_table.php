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
        Schema::create('families', function (Blueprint $table) {
            $table->bigIncrements('id_families');
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
