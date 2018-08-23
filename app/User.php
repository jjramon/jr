<?php

namespace colegioShaddai;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificacion', 'nombre', 'apellido', 'genero', 'direccion', 'fechaNacimiento',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    *
    *protected $hidden = [
     *   'password', 'remember_token',
    ]; */
}
