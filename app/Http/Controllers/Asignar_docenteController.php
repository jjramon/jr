<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Asignar_docente;
use colegioShaddai\Persona;

class Asignar_docenteController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

      
        if($buscar == '' && $criterio=='')
            {
                $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
                ->join('materias','asignar_docente.idMateria','=','materias.id')
                ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
                ->join('grados','asignar_materia.idGrado','=','grados.id')
                ->join('secciones','grados.idSeccion','=','secciones.id')
                ->join('carreras','grados.idCarrera','=','carreras.id')
                ->join('niveles','grados.idNivel','=','niveles.id')
                ->where('personas.estado','=','1')
                ->where('materias.estado','=','1')
                ->select('personas.id as idDocente', 'personas.nombre as nombreDocente', 'personas.apellido as apellidoDocente',
                'personas.identificacion as DPIDocente', 'asignar_docente.id as idAsignacion', 'asignar_docente.idDocente as idAsignacionDocente', 
                'asignar_docente.idMateria as idAsignacionMateria','materias.id as idMateria', 'materias.nombre as nombreMateria',
                'grados.nombre as nombreGrado','secciones.nombre as nombreSeccion','carreras.nombre as nombreCarrera','niveles.nombre as nombreNivel')
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
            
            'docente'=> $alumnos
        ];
    }
    

    public function SelectDocente(Request $request)
    {
        $select=Persona::join('tipo_personas', 'idTipoPersona','=','tipo_personas.id' )
        ->where('tipo_personas.nombre','=','Docente')
        ->where('personas.estado','=','1')
        ->select('personas.id as idDocente','personas.nombre as nombreDocente', 'personas.apellido as apellidoDocente', 'personas.identificacion as DPIDocente','tipo_personas.nombre as nombreTPersona')->take(1)->get();
        return ['docente' => $select];
    }
    

    public function store(Request $request)
    {
                $insertar = new Asignar_docente();
                $insertar -> idDocente = $request->idDocente;
                $insertar -> idMateria = $request->idMateria;
                $insertar -> save();
            
    }
    
  
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
            $actualizar = Asignar_docente::findOrFail($request->idAsignacion); 
            $actualizar -> idDocente = $request->idDocente;
            $actualizar -> idMateria = $request->idMateria;
            $actualizar -> save();
        
    }

}