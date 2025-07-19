<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoAdjunto extends Model
{
    protected $fillable = ['curso_id', 'archivo', 'tipo'];
}
