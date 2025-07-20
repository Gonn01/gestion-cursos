<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoAdjunto extends Model
{
    protected $table = 'archivos_adjuntos';
    protected $fillable = ['curso_id', 'archivo', 'tipo'];
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
