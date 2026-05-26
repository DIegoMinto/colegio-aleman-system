<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';

    protected $primaryKey = 'id_calificaciones';

    protected $fillable = [
        'id_evaluaciones',
        'id_estudiantes',
        'nota'
    ];

    public function evaluacion()
    {
        return $this->belongsTo(
            Evaluacion::class,
            'id_evaluaciones',
            'id_evaluaciones'
        );
    }

    public function estudiante()
    {
        return $this->belongsTo(
            Estudiante::class,
            'id_estudiantes',
            'id_estudiantes'
        );
    }
}