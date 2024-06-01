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
        Schema::create('psychologists', function (Blueprint $table) {
            $table->bigIncrements('id_psychologists');
            $table->string('name');
            $table->string('id_card_number');
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->string('photo');
            $table->string('school');
            $table->string('graduated_year');
            $table->string('certificate');
            $table->string('strp_number');
            $table->string('strp');
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('psychologists');
    }
};
