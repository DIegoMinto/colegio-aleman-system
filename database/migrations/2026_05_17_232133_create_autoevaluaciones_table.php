<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('autoevaluaciones', function (Blueprint $table) {

            $table->id('id_autoevaluaciones');

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

            $table->unique([
                'id_asignaciones',
                'id_trimestres'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autoevaluaciones');
    }
};