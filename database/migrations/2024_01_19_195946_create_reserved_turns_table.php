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
        Schema::create('reserved_turns', function (Blueprint $table) {
            $table->id();
            $table-> string('nombre');
            $table-> string('apellido');
            $table-> bigInteger('celular')->nullable();
            $table-> mediumText('email')->nullable();
            $table-> bigInteger('dni');
            $table-> integer('obra_social')->nullable();
            $table-> string ('numero_obraSocial')->nullable();
            $table-> integer('id_horario_atencion');
            $table-> mediumText('observacion')->nullable();
            $table-> integer('estado');
            $table-> integer('notificacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserved_turns');
    }
};
