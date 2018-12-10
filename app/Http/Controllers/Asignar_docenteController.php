<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Asignar_docente;
use colegioShaddai\Persona;
use Illuminate\Support\Facades\DB;

class Asignar_docenteController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $criterio = $request->criterio;
        $std = $request->std;
        $idCiclo = $request->idCiclo;
        
    
        if($std == 1)
            {
                if($criterio != 4)
                {
                    $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
                    ->join('materias','asignar_docente.idMateria','=','materias.id')
                    ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
                    ->join('grados','asignar_materia.idGrado','=','grados.id')
                    ->join('secciones','grados.idSeccion','=','secciones.id')
                    ->join('niveles','grados.idNivel','=','niveles.id')
                    ->join('ciclos', 'asignar_docente.idCiclo', '=','ciclos.id')
                    ->where('asignar_docente.estado','=','1')
                    ->where('niveles.id', '=', $criterio)
                    ->where('personas.estado','=','1')
                    ->where('materias.estado','=','1')
                    ->where('asignar_docente.idCiclo', '=', $idCiclo)
                    ->select('personas.id as idDocente', 'materias.id as idMateria', DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombreDocente'),
                    'asignar_docente.id as idAsignacion', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", secciones.nombre) as nombreMateria'), 
                    'ciclos.id as idCiclo', 'ciclos.nombre as nombreCiclo', 'asignar_docente.estado','niveles.id as idNivel')
                    ->orderBy('nombreDocente', 'asc')->paginate(10);    
                }
                
                if($criterio == 4)
                {
                    $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
                    ->join('materias','asignar_docente.idMateria','=','materias.id')
                    ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
                    ->join('grados','asignar_materia.idGrado','=','grados.id')
                    ->join('secciones','grados.idSeccion','=','secciones.id')
                    ->join('carreras','grados.idCarrera','=','carreras.id')
                    ->join('niveles','grados.idNivel','=','niveles.id')
                    ->join('ciclos', 'asignar_docente.idCiclo', '=','ciclos.id')
                    ->where('niveles.id', '=', $criterio)
                    ->where('carreras.id', '=', $buscar)
                    ->where('asignar_docente.estado','=','1')
                    ->where('personas.estado','=','1')
                    ->where('materias.estado','=','1')
                    ->where('asignar_docente.idCiclo', '=', $idCiclo)
                    ->select('personas.id as idDocente', 'materias.id as idMateria',DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombreDocente'),
                    'asignar_docente.id as idAsignacion', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", secciones.nombre) as nombreMateria'), 
                    'ciclos.id as idCiclo', 'ciclos.nombre as nombreCiclo', 'asignar_docente.estado','niveles.id as idNivel')
                    ->orderBy('nombreGrado', 'asc')->paginate(10);
                }
            } 
            if($std == 2)
            {
                if($criterio != 4)
                {
                    $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
                    ->join('materias','asignar_docente.idMateria','=','materias.id')
                    ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
                    ->join('grados','asignar_materia.idGrado','=','grados.id')
                    ->join('secciones','grados.idSeccion','=','secciones.id')
                    ->join('niveles','grados.idNivel','=','niveles.id')
                    ->join('ciclos', 'asignar_docente.idCiclo', '=','ciclos.id')
                    ->where('asignar_docente.estado','=','0')
                    ->where('niveles.id', '=', $criterio)
                    ->where('personas.estado','=','1')
                    ->where('materias.estado','=','1')
                    ->where('asignar_docente.idCiclo', '=', $idCiclo)
                    ->select('personas.id as idDocente', 'materias.id as idMateria', DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombreDocente'),
                    'asignar_docente.id as idAsignacion', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", secciones.nombre) as nombreMateria'), 
                    'ciclos.id as idCiclo', 'ciclos.nombre as nombreCiclo', 'asignar_docente.estado','niveles.id as idNivel')
                    ->orderBy('nombreDocente', 'asc')->paginate(10);    
                }
                
                if($criterio == 4)
                {
                    $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
                    ->join('materias','asignar_docente.idMateria','=','materias.id')
                    ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
                    ->join('grados','asignar_materia.idGrado','=','grados.id')
                    ->join('secciones','grados.idSeccion','=','secciones.id')
                    ->join('carreras','grados.idCarrera','=','carreras.id')
                    ->join('niveles','grados.idNivel','=','niveles.id')
                    ->join('ciclos', 'asignar_docente.idCiclo', '=','ciclos.id')
                    ->where('niveles.id', '=', $criterio)
                    ->where('carreras.id', '=', $buscar)
                    ->where('asignar_docente.estado','=','0')
                    ->where('personas.estado','=','1')
                    ->where('materias.estado','=','1')
                    ->where('asignar_docente.idCiclo', '=', $idCiclo)
                    ->select('personas.id as idDocente', 'materias.id as idMateria', DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombreDocente'),
                    'asignar_docente.id as idAsignacion', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", secciones.nombre) as nombreMateria'), 
                    'ciclos.id as idCiclo', 'ciclos.nombre as nombreCiclo', 'asignar_docente.estado','niveles.id as idNivel')
                    ->orderBy('nombreGrado', 'asc')->paginate(10);
                }
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
                $insertar -> idCiclo = $request->idCiclo;
                $insertar -> estado = "1";
                $insertar -> save();
            
    }
    
  
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
            $actualizar = Asignar_docente::findOrFail($request->id); 
            $actualizar -> idDocente = $request->idDocente;
            $actualizar -> idMateria = $request->idMateria;
            $actualizar -> idCiclo = $request->idCiclo;
            $actualizar -> estado = "1";
            $actualizar -> save();
        
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $desactivar =  Asignar_docente::findOrFail($request->id);
        $desactivar -> estado = '0';
        $desactivar -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $activar =  Asignar_docente::findOrFail($request->id);
        $activar -> estado = '1';
        $activar -> save();
    }

}