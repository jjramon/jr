<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Asignar_padre_alumno;

class AsgPadreAlumController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

      
        if($buscar == '' && $criterio=='')
            {
                $alumnos = Asignar_padre_alumno::join('alumnos', 'idAlumno', '=', 'alumnos.id')
                ->join('personas','alumnos.idPersona','=','personas.id')
                ->join('personas as person', 'asignar_padre_alumnos.idPersona', '=', 'person.id')
                ->where('personas.estado','=', '1')
                ->select('personas.id as idAlumno', 'personas.nombre as nombreAlumno', 'personas.apellido as apellidoAlumno',
                'personas.identificacion as codigoAlumno', 'asignar_padre_alumnos.id as idAsignacion', 'asignar_padre_alumnos.idAlumno as idAlumnoAsig', 
                'asignar_padre_alumnos.idPersona as idPadre', 'person.nombre as nombrePadre', 'person.apellido as apellidoPadre' ,'person.tel as telPadre', 
                'person.identificacion as dpiPadre', 'asignar_padre_alumnos.estado as estadoAsignacion')
                ->orderBy('personas.nombre', 'asc')->paginate(10);


                
            }
        if($criterio != '' && $buscar == '')
            {
                
            } 
        if($criterio != '' && $buscar != '')
        {
         
        }

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
    


    

    public function store(Request $request)
    {

       
                $insertar = new Asignar_padre_alumno();
                $insertar -> idPersona = $request->idPersona;
                $insertar -> idAlumno = $request->idAlumno;
                $insertar -> save();
            
            
    }
    
  
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
            $actualizar = Asignar_padre_alumno::findOrFail($request->idAsignacion); 
            $actualizar -> idPersona = $request->idPersona;
            $actualizar -> idAlumno = $request->idAlumno;
            $actualizar -> save();
        
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $desactivar=  Asignar_padre_alumno::findOrFail($request->idAsig);
            $desactivar-> estado = '0';
            $desactivar-> save();

            
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $activar =  Asignar_padre_alumno::findOrFail($request->idAsig);
            $activar -> estado = '1';
            $activar -> save();

    }
   
}
