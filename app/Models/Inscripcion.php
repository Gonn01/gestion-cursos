<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    protected $fillable = ['alumno_id', 'curso_id', 'estado', 'nota', 'asistencia'];
}
