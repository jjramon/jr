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
        'id', 'idPersona', 'idRol', 'usuario', 'password', 'pdef','estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password', 'pdef', 'remember_token',
    ]; 
    public function rol(){
        return $this->belongsTo('colegioShaddai\Rol');
    }
    public function persona(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
}
