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
            $table-> date('fecha_nacimiento')->nullable();
            $table-> bigInteger('celular')->nullable();
            $table-> bigInteger('telefono')->nullable();
            $table-> string('email')->nullable();
            $table-> integer('obra_social')->nullable();
            $table-> bigInteger('numero_obraSocial')->nullable();
            $table-> mediumText('observacion')->nullable();
            $table-> string('direccion')->nullable();
            $table-> string('pais_residencia')->nullable();
            $table-> string('localidad_residencia')->nullable();
            $table-> string ('provincia_residencia')->nullable();
            $table-> integer('id_especialista')->nullable();
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
