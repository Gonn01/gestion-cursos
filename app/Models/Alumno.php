<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = ['nombre', 'dni', 'email', 'fecha_nacimiento', 'activo'];
}
