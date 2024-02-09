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
            $table-> bigInteger('celular')->nullable();
            $table-> bigInteger('telefono')->nullable();
            $table-> string('email');
            $table->string('password');
            $table-> integer('especialidad')->nullable();
            $table-> string('matricula')->nullable();
            $table-> string('dia_atencion')->nullable();
            $table-> string('hr_atencion')->nullable();
            $table-> string('localidad_residencia')->nullable();
            $table-> string ('provincia_residencia')->nullable();
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
