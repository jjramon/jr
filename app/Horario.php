<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    //
    protected $fillable = [
        'horario', 'horario_salida', 'idDia', 'estado'
    ];
    public function dia(){
            return $this->belongsTo('colegioShaddai\Dia');
        }
    
}
