<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluaciones';
    protected $fillable = ['alumno_id', 'curso_id', 'nota'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}
