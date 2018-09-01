<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    //
    protected $fillable =  ['nombre','estado'];
    public function horarios()
    {
        return $this->hasMany('colegioShaddai\Horario');
    }
}