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
            $table->string('id_familia');
            /*  $table->string('id_familia')->default('2R0N8');;  */
            /* $table->integer('id_familia')->default(1);;  */
            $table->string('name');
            $table->string('apellido');
           // $table->string('telefono')->nullable();
            $table->string('telefono')->unique();
            $table->string('categoria')->default('Pendiente');
            $table->string('status')->default('Pendiente');
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
