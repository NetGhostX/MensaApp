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
        Schema::create('benutzer', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('email', 100)->unique();
            $table->string('passwort', 200);
            $table->boolean('admin')->default(false);
            $table->integer('anzahlfehler')->default(0);
            $table->integer('anzahlanmeldungen')->default(0);
            $table->dateTime('letzteanmeldung')->nullable();
            $table->dateTime('letzterfehler')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benutzer');
    }
};
