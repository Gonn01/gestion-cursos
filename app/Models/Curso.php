<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre', 'estado', 'modalidad', 'aula_virtual', 'docente_id', 'limite_inscriptos'];
}
