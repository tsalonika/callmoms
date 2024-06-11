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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_users');
            $table->string('phoneNumber')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->string('photo');
            $table->enum('role', ['mom', 'family', 'psychologist', 'admin']);
            $table->string('password');
            $table->date('birthOfDate');
            $table->string('birthOfPlace');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
