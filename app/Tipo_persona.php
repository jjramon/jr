<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Tipo_persona extends Model
{
    //
    protected $fillable =  ['nombre','estado'];

    public function persona()
    {
        return $this->hasMany('colegioShaddai\Persona');
    }

}
