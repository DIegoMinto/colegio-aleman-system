<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calificaciones', function (Blueprint $table) {

            $table->id('id_calificaciones');

            $table->unsignedBigInteger('id_evaluaciones');
            $table->unsignedBigInteger('id_estudiantes');

            $table->decimal('nota', 5, 2);

            $table->timestamps();

            $table->foreign('id_evaluaciones')
                ->references('id_evaluaciones')
                ->on('evaluaciones')
                ->onDelete('cascade');

            $table->foreign('id_estudiantes')
                ->references('id_estudiantes')
                ->on('estudiantes')
                ->onDelete('cascade');

            $table->unique([
                'id_evaluaciones',
                'id_estudiantes'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};