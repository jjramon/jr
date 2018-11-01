<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Asignar_docente extends Model
{
    //
    protected $table = 'asignar_docente';
    protected $filelable = ['id', 'idDocente','idMateria', 'idCiclo', 'estado'];
    public function persona(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
    public function materias(){
        return $this->belongsTo('colegioShaddai\Materia');
    }
}
