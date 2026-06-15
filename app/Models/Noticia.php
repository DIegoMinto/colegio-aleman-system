<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id_noticias';
    protected $fillable = ['titulo', 'contenido', 'archivo_url', 'tipo_archivo'];
}