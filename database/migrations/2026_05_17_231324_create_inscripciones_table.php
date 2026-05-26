<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {

            $table->id('id_inscripciones');

            $table->unsignedBigInteger('id_estudiantes');
            $table->unsignedBigInteger('id_cursos');

            $table->timestamps();

            $table->foreign('id_estudiantes')
                ->references('id_estudiantes')
                ->on('estudiantes')
                ->onDelete('cascade');


            $table->foreign('id_cursos')
                ->references('id_cursos')
                ->on('cursos')
                ->onDelete('cascade');

            $table->unique([
                'id_estudiantes',
                'id_cursos'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};