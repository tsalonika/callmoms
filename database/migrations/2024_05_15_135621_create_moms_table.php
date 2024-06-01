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
        Schema::create('moms', function (Blueprint $table) {
            $table->bigIncrements('id_moms');
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('photo');
            $table->string('children_num');
            $table->integer('year_marriage');
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
        Schema::dropIfExists('moms');
    }
};
