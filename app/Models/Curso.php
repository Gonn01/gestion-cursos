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
        'estado',
        'cupo_maximo',
        'docente_id',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function archivosAdjuntos()
    {
        return $this->hasMany(ArchivoAdjunto::class);
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
}
