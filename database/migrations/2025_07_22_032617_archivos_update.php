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

        Schema::create('archivos', function (Blueprint $table) {
        $table->id();
        $table->integer('id_paciente');
        $table->integer('id_especialista')->nullable();        
        $table->string('nombre');
        $table->integer('tipoArchivo');
        $table->string('ruta');
        $table->timestamps();
         });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
