<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Asignar_padre_alumno extends Model
{
    //
    protected $filelable = ['id', 'idAlumno', 'idPersona', 'estado'];
    
    public function Personas(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
    public function Alumnos(){
        return $this->belongsTo('colegioShaddai\Alumno');
    }
}
