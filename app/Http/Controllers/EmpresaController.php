<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Empresa;
class EmpresaController extends Controller
{
    //
    public function Empresa(){
        $colegio= Empresa::all()->first();
        return ($colegio->Nombre);
    }
}
