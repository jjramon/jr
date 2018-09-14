<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $fillable =  ['nombre','descripcion','estado',];

    public function user(){
        return $this->hasMany('colegioShaddai\User');
    }

}

