<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
        protected $fillable =  ['genero','estado'];
        
        public function persona()
        {
            return $this->hasMany('colegioShaddai\Persona');
        }
    
}
