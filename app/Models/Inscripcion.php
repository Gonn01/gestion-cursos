<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'alumno_id',
        'curso_id',
        'fecha_inscripcion',
        'estado',
        'nota_final',
        'asistencias',
        'observaciones',
        'evaluado_por_docente',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
