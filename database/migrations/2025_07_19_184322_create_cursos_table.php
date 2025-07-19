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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado', ['activo', 'finalizado', 'cancelado']);
            $table->enum('modalidad', ['presencial', 'virtual', 'hibrido']);
            $table->string('aula_virtual')->nullable();
            $table->unsignedBigInteger('docente_id');
            $table->integer('limite_inscriptos')->default(30);
            $table->timestamps();

            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
