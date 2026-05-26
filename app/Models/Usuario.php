<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $rememberTokenName = null;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuarios';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'email',
        'user',
        'password',
        'id_roles',
        'id_personas'
    ];

    public function rol()
    {
        return $this->belongsTo(Role::class, 'id_roles', 'id_roles');
    }

    public function persona()
    {
        return $this->belongsTo(
            Persona::class,
            'id_personas',
            'id_personas'
        );
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
