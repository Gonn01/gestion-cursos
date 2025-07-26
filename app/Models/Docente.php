<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'especialidad',
        'telefono',
        'direccion',
        'activo',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
