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
        Schema::create('invitados', function (Blueprint $table) {
            $table->id(); // Crea un campo id autoincremental
            $table->string('name');
            $table->string('apellido');
            $table->string('email');
            $table->string('telefono');
            $table->integer('pases');
            $table->integer('confirmados')->default(0);
            $table->string('status')->default('No');
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitados');
    }
};