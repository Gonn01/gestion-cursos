<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'modalidad',
        'aula_virtual',
        'fecha_inicio',
        'fecha_fin',
        'cupo_maximo',
        'activo',
        'docente_id'
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
