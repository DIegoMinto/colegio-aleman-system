<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detalle_autoevaluacion', function (Blueprint $table) {

            $table->id('id_detalle_autoevaluacion');

            $table->unsignedBigInteger('id_autoevaluaciones');
            $table->unsignedBigInteger('id_estudiantes');

            $table->decimal('ser', 5, 2);
            $table->decimal('saber', 5, 2);
            $table->decimal('hacer', 5, 2);
            $table->decimal('decidir', 5, 2);

            $table->timestamps();

            $table->foreign('id_autoevaluaciones')
                ->references('id_autoevaluaciones')
                ->on('autoevaluaciones')
                ->onDelete('cascade');

            $table->foreign('id_estudiantes')
                ->references('id_estudiantes')
                ->on('estudiantes')
                ->onDelete('cascade');

            $table->unique([
                'id_autoevaluaciones',
                'id_estudiantes'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_autoevaluacion');
    }
};