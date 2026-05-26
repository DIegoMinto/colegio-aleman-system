<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id('id_materias');

            $table->string('nombre', 100);

            $table->unsignedBigInteger('id_areas');
            $table->unsignedBigInteger('id_tipos');

            $table->timestamps();


            $table->foreign('id_areas')
                ->references('id_areas')
                ->on('areas')
                ->onDelete('cascade');

            $table->foreign('id_tipos')
                ->references('id_tipos')
                ->on('tipos_materia')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};