<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey = 'id_estudiantes';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personas', 'id_personas');
    }
}
