<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Asignar_materia extends Model
{
    protected $table = 'asignar_materia';
    protected $filelable = ['id', 'idGrado','idMateria', 'estado'];
    public function persona(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
    public function materias(){
        return $this->belongsTo('colegioShaddai\Materia');
    }
}
