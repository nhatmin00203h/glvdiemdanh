<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');

            // Google OAuth (customer)
            $table->string('google_id', 191)->unique()->nullable();

            // Display only
            $table->string('email', 191)->nullable();

            // Local auth (admin)
            $table->string('username', 191)->unique()->nullable();
            $table->string('password')->nullable();

            $table->enum('role', ['admin', 'customer']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
