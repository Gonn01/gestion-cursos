<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->string('titulo')->after('nombre');
            $table->text('descripcion')->nullable()->after('titulo');
            $table->date('fecha_inicio')->nullable()->after('descripcion');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
            $table->unsignedInteger('cupo_maximo')->nullable()->after('fecha_fin');
            $table->boolean('activo')->default(true)->after('cupo_maximo');
        });
    }

    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn([
                'titulo',
                'descripcion',
                'fecha_inicio',
                'fecha_fin',
                'cupo_maximo',
                'activo',
            ]);
        });
    }

};
