<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = 'meses';
    protected $fillable =  ['nombre','estado'];
}
