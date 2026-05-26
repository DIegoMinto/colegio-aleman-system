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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuarios');

            $table->string('email')->unique();
            $table->string('user')->unique();
            $table->string('password');

            $table->unsignedBigInteger('id_personas');
            $table->unsignedBigInteger('id_roles');

            $table->foreign('id_personas')
                ->references('id_personas')
                ->on('personas')
                ->onDelete('cascade');
            $table->foreign('id_roles')
                ->references('id_roles')
                ->on('roles')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
