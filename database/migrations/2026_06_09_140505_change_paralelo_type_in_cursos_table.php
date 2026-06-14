<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Cambiamos el tipo de integer a string para aceptar letras
            $table->string('paralelo', 10)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Por si necesitas volver atrás, regresaría a entero (¡Ojo! Solo si está vacío)
            $table->integer('paralelo')->change();
        });
    }
};