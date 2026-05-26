<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {

            $table->id('id_evaluaciones');

            $table->string('nombre', 100);

            $table->string('tipo', 50);

            $table->decimal('porcentaje', 5, 2);

            $table->unsignedBigInteger('id_asignaciones');
            $table->unsignedBigInteger('id_trimestres');

            $table->timestamps();

            $table->foreign('id_asignaciones')
                ->references('id_asignaciones')
                ->on('asignaciones')
                ->onDelete('cascade');

            $table->foreign('id_trimestres')
                ->references('id_trimestres')
                ->on('trimestres')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};