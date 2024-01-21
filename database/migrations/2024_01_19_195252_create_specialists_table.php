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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table-> string('nombre');
            $table-> string('apellido');
            $table-> bigInteger('dni')->unique();
            $table-> bigInteger('celular');
            $table-> bigInteger('telefono');
            $table-> string('email');
            $table->string('password');
            $table-> integer('especialidad');
            $table-> string('matricula');
            $table-> string('dia_atencion');
            $table-> string('hr_atencion');
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
        Schema::dropIfExists('specialists');
    }
};
