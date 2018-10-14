<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    //
    protected $fillable =  ['nombre','estado'];
    public function asignar_docente(){
        return $this->hasOne('colegioShaddai\Asignar_docente');
    }
}
