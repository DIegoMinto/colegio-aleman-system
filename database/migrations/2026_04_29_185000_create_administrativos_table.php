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
        Schema::create('administrativos', function (Blueprint $table) {
            $table->bigIncrements('id_administrativos');

            $table->unsignedBigInteger('id_personas')->unique();

            $table->foreign('id_personas')
                ->references('id_personas')
                ->on('personas')
                ->cascadeOnDelete();

            $table->string('cargo')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrativos');
    }
};
