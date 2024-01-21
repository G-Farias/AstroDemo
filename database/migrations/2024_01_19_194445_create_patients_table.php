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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table-> string('nombre');
            $table-> string('apellido');
            $table-> bigInteger('dni')->unique();
            $table-> date('fecha_nacimiento');
            $table-> bigInteger('celular');
            $table-> bigInteger('telefono');
            $table-> string('email');
            $table-> integer('obra_social');
            $table-> bigInteger('numero_obraSocial');
            $table-> mediumText('observacion');
            $table-> string('direccion');
            $table-> string('pais_residencia');
            $table-> string('localidad_residencia');
            $table-> string ('provincia_residencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
