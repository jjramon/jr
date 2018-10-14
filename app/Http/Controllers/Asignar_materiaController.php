<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Materia;
use colegioShaddai\Grado;
use colegioShaddai\Nivele;
use colegioShaddai\Asignar_materia;
class Asignar_materiaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

      
        if($buscar == '' && $criterio=='')
            {
                $materia = Asignar_materia::join('materias','idMateria','=','materias.id')
                ->join('grados','asignar_materia.idGrado','=','grados.id')
                ->join('niveles','niveles.id','=','grados.idNivel')
                ->join('carreras','carreras.id','=','grados.idCarrera')
                ->join('secciones','secciones.id','=','grados.idSeccion')
                ->where('grados.estado','=','1')
                ->where('materias.estado','=','1')
                ->select('asignar_materia.id as idAsignacion','materias.id as idMateria', 'grados.id as idGrado', 'materias.nombre as nombreMateria',
                'grados.nombre as nombreGrado', 'secciones.nombre as nombreSeccion', 'carreras.nombre as nombreCarrera','niveles.nombre as nombreNivel')
                ->orderBy('materias.nombre', 'asc')->paginate(10);


                
            }
        if($criterio != '' && $buscar == '')
            {
                
            } 
        if($criterio != '' && $buscar != '')
        {
         
        }

        return [
            
            'pagination'=> [
                'total'         =>  $materia ->total(),
                'current_page'  =>  $materia ->currentPage(),
                'per_page'      =>  $materia ->perPage(),
                'last_page'     =>  $materia ->lastPage(),
                'from'          =>  $materia ->firstItem(),
                'to'            =>  $materia ->lastItem(),
            ],
            
            'asigMateria'=> $materia
        ];
    }
    

    public function SelectMateria(Request $request)
    {
        $filtro=$request->filtro;
        $select=Materia::where('estado','=','1')
        ->where('nombre','like', '%'.$filtro.'%')
        ->select('nombre as nombreMateria', 'id as idMateria')->take(1)->get();
        return ['materia' => $select];
    }
    public function SelectNivel(Request $request)
    {
        $select=Nivele::where('estado','=','1')
        ->select('nombre as nombreNivel', 'id as idNivel')->get();
        return ['nivel' => $select];
    }
    public function SelectGrado(Request $request)
    {
        $filtro=$request->filtro;
        $select=Grado::join('secciones', 'grados.idSeccion','=', 'secciones.id')
        ->join('carreras', 'grados.idCarrera','=', 'carreras.id')
        ->join('niveles', 'grados.idNivel','=', 'niveles.id')
        ->where('grados.estado','=','1')
        ->where('grados.idNivel','=',$filtro)
        ->select('grados.id as idGrado','grados.nombre as nombreGrado', 
        'secciones.nombre as nombreSeccion','carreras.nombre as nombreCarrera')->get();
        return ['grado' => $select];
    }

    public function store(Request $request)
    {
                $insertar = new Asignar_materia();
                $insertar -> idGrado = $request->idGrado;
                $insertar -> idMateria = $request->idMateria;
                $insertar -> save();
            
    }
    
  
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
            $actualizar = Asignar_materia::findOrFail($request->idAsignacion); 
            $actualizar -> idGrado = $request->idGrado;
            $actualizar -> idMateria = $request->idMateria;
            $actualizar -> save();
        
    }

}