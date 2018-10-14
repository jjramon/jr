<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Asignar_alumno;

class Asignar_alumnoController extends Controller
{
    //
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
       
        
     $alumnos = Asignar_alumno::orderBy('id', 'asc')->paginate(10);
 

        return [
            
            'pagination'=> [
                'total'         =>  $alumnos ->total(),
                'current_page'  =>  $alumnos ->currentPage(),
                'per_page'      =>  $alumnos ->perPage(),
                'last_page'     =>  $alumnos ->lastPage(),
                'from'          =>  $alumnos ->firstItem(),
                'to'            =>  $alumnos ->lastItem(),
            ],
            
            'alumnos'=> $alumnos
        ];
    }
    
}
