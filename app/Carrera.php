<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $fillable =  ['nombre', 'estado'];
    public function grados()
    {
        return $this->hasMany('colegioShaddai\Grado');
    }
}
