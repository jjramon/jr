<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class calificacione extends Model
{
    //
    protected $filelable = ['id', 'idMateria', 'idBimestre', 'idDocente', 'idAlumno', 'idCiclo', 'calificacion',  'estado'];

    public function persona(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
    public function asignarpadrealumno(){
        return $this->hasOne('colegioShaddai\Asignar_padre_alumno');
    }
    public function asignaralumno(){
        return $this->hasOne('colegioShaddai\Asignar_alumno');
    }
    public function ciclo(){
        return $this->hasOne('colegioShaddai\Ciclo');
    }
        
}
