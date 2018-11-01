<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Materia;
use colegioShaddai\Grado;
use colegioShaddai\Nivele;
use colegioShaddai\Asignar_materia;
use Illuminate\Support\Facades\DB;
class Asignar_materiaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $std = $request->std;
        $cilco= $request->ciclo;

        
            if($std == 1 ){

                $materia = Asignar_materia::join('materias','idMateria','=','materias.id')
                ->join('grados','asignar_materia.idGrado','=','grados.id')
                ->join('niveles','niveles.id','=','grados.idNivel')
                ->join('ciclos', 'ciclos.id', '=', 'asignar_materia.idCiclo')
                ->where('grados.estado','=','1')
                ->where('materias.estado','=','1')
                ->where('niveles.id','=', $criterio)
                ->where('grados.id', '=', $buscar)
                ->where('asignar_materia.estado', '=', '1')
                ->select('asignar_materia.id as id', 'asignar_materia.idMateria as idMateria', 'niveles.id as idNivel',
                'grados.id as idGrado', 'materias.nombre as nombreMateria', 'asignar_materia.estado as estado')
                ->orderby('nombreMateria')->paginate(10);

            }
            if($std ==2 ){
                $materia = Asignar_materia::join('materias','idMateria','=','materias.id')
                ->join('grados','asignar_materia.idGrado','=','grados.id')
                ->join('niveles','niveles.id','=','grados.idNivel')
                ->where('grados.estado','=','1')
                ->where('materias.estado','=','1')
                ->where('niveles.id','=', $criterio)
                ->where('grados.id', '=', $buscar)
                ->where('asignar_materia.estado', '=', '0')
                ->select('asignar_materia.id as id', 'asignar_materia.idMateria as idMateria', 'niveles.id as idNivel',
                'grados.id as idGrado', 'materias.nombre as nombreMateria', 'asignar_materia.estado as estado')
                ->orderby('nombreMateria')->paginate(10);
            }
        return [
            
            'pagination'=> [
                'total'         =>  $materia ->total(),
                'current_page'  =>  $materia ->currentPage(),
                'per_page'      =>  $materia ->perPage(),
                'last_page'     =>  $materia ->lastPage(),
                'from'          =>  $materia ->firstItem(),
                'to'            =>  $materia ->lastItem()
            ],
            
            'asigMateria'=> $materia           
        ];
    }
    

    public function SelectMateria(Request $request)
    {
        $select=Materia::where('estado','=','1')
        ->select('nombre', 'id')->get();
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
  
            $actualizar = Asignar_materia::findOrFail($request->id); 
            $actualizar -> idGrado = $request->idGrado;
            $actualizar -> idMateria = $request->idMateria;
            $actualizar -> estado = '1';
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