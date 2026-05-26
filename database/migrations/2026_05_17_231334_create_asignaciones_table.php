<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {

            $table->id('id_asignaciones');

            $table->unsignedBigInteger('id_docentes');
            $table->unsignedBigInteger('id_cursos');
            $table->unsignedBigInteger('id_materias');

            $table->integer('gestion');

            $table->timestamps();

            $table->foreign('id_docentes')
                ->references('id_docentes')
                ->on('docentes')
                ->onDelete('cascade');

            $table->foreign('id_cursos')
                ->references('id_cursos')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('id_materias')
                ->references('id_materias')
                ->on('materias')
                ->onDelete('cascade');

            $table->unique([
                'id_docentes',
                'id_cursos',
                'id_materias',
                'gestion'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};