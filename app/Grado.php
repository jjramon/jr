<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    //
    protected $fillable = ['idNivel', 'idSeccion','idCarrera','nombre','estado'];
    public function niveles(){
        return $this->belongsTo('colegioShaddai\Nivele');
    }
    
    public function carreras(){
        return $this->belongsTo('colegioShaddai\Carreras');
    }
    public function secciones(){
        return $this->belongsTo('colegioShaddai\Secciones');
    }
    
}
