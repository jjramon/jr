<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Asignar_alumno extends Model
{
    //
    protected $fillable =  ['idGrado', 'idAlumno', 'estado'];


    public function Alumnos(){
        return $this->belongsTo('colegioShaddai\Alumno');
    }
}
