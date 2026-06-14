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
            // Renombra la columna antigua por la nueva
            $table->renameColumn('gestion', 'paralelo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Por si necesitas revertir el cambio en el futuro
            $table->renameColumn('paralelo', 'gestion');
        });
    }
};