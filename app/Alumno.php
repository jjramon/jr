<?php

namespace colegioShaddai;
use Carbon\Carbon;
use  Jenssegers \ Date \ Date ;
use Illuminate\Database\Eloquent\Model;



class Alumno extends Model
{
    //
    protected $filelable = ['id', 'idPersona'];
    protected $dates = ['fechaNacimiento'];
    public function persona(){
        return $this->belongsTo('colegioShaddai\Persona');
    }
    
}