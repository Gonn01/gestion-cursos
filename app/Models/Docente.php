<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'nombre',
        'dni',
        'email',
        'fecha_nacimiento',
        'activo'
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
