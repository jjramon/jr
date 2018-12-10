<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $filelable = ['id', 'idGenero', 'idTipoPersona', 'nombre', 'apellido', 'tel', 'tel2', 'direccion', 'identificacion', 'correo'];
    
    public function alumno(){
        return $this->hasOne('colegioShaddai\Alumno');
    }    

    public function tipo_personas(){
        return $this->belongsTo('colegioShaddai\Tipo_persona');
    }
    
    public function genereos(){
        return $this->belongsTo('colegioShaddai\Genero');
    }
    
    public function user(){
        return $this->hasOne('colegioShaddai\User');
    }
    public function asignarpadres(){
        return $this->hasOne('colegioShaddai\asignar_padre_alumno');
    }
}

