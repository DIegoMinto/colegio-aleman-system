<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMateria extends Model
{
    protected $table = 'tipos_materia';

    protected $primaryKey = 'id_tipos';

    protected $fillable = [
        'nombre'
    ];

    public function materias()
    {
        return $this->hasMany(
            Materia::class,
            'id_tipos',
            'id_tipos'
        );
    }
}