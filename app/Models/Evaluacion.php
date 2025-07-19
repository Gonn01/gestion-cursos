<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $fillable = ['alumno_id', 'curso_id', 'nota'];
}
