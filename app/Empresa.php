<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $filelable = ['Nombre', 'Direccion', 'Tel', 'Nit'];
}
