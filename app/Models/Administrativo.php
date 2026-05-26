<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $primaryKey = 'id_administrativos';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personas', 'id_personas');
    }

}
