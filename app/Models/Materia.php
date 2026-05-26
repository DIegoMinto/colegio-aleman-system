<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';

    protected $primaryKey = 'id_materias';

    protected $fillable = [
        'nombre',
        'id_areas',
        'id_tipos'
    ];

    public function area()
    {
        return $this->belongsTo(
            Area::class,
            'id_areas',
            'id_areas'
        );
    }

    public function tipo()
    {
        return $this->belongsTo(
            TipoMateria::class,
            'id_tipos',
            'id_tipos'
        );
    }
}