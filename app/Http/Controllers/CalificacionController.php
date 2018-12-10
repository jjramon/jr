<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Asignar_docente;
use colegioShaddai\Asignar_alumno;
use colegioShaddai\Persona;
use colegioShaddai\calificacione;
use colegioShaddai\detalle_calificacione;
use colegioShaddai\Bimestre;
use colegioShaddai\Alumno;
use colegioShaddai\Ciclo;
use colegioShaddai\Asignar_padre_alumno;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       
        $criterio = $request->criterio;
        $buscar = $request->buscar;
        $idCiclo = $request->idCiclo;
        $idBimestre = $request->idBimestre;
        
    

            $alumnos = Persona::join('alumnos', 'personas.id', '=', 'alumnos.idPersona')
            ->join('calificaciones', 'alumnos.id', '=', 'calificaciones.idAlumno')
            ->join('asignar_materia','asignar_materia.idMateria','=','calificaciones.idMateria')
            ->join('bimestres', 'bimestres.id', '=', 'calificaciones.idBimestre')
            ->join('materias', 'materias.id', '=', 'calificaciones.idMateria')
            ->where('calificaciones.idMateria','=', $criterio)
            ->where('calificaciones.idCiclo', '=', $idCiclo)
            ->where('calificaciones.idBimestre', '=', $idBimestre)
            ->select('calificaciones.id as idCalificacion','personas.id as idAlumno', DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombre'), 
            'calificaciones.calificacion',  'bimestres.id as idBimestre', 'materias.nombre as nombreMateria')
            ->orderBy('nombre', 'asc')->paginate(10);    
   
        
       
           
            
            

        return [
            
            'pagination'=> [
                'total'         =>  $alumnos ->total(),
                'current_page'  =>  $alumnos ->currentPage(),
                'per_page'      =>  $alumnos ->perPage(),
                'last_page'     =>  $alumnos ->lastPage(),
                'from'          =>  $alumnos ->firstItem(),
                'to'            =>  $alumnos ->lastItem(),
            ],
            
            'calificacion'=> $alumnos
        ];
    }

    public function verCalificacion(Request $request){
    {
            //if (!$request->ajax()) return redirect('/');
            $criterio = $request->criterio;
            $idCiclo = $request->idCiclo;
            $idBimestre = $request->idBimestre;

                $alumnos = calificacione::join('detalle_calificaciones', 'calificaciones.id', '=', 'detalle_calificaciones.idCalificacion')
                ->join('alumnos', 'alumnos.id', '=', 'calificaciones.idAlumno')
                ->join('materias', 'materias.id', '=', 'calificaciones.idMateria')
                ->join('bimestres', 'bimestres.id', '=', 'calificaciones.idBimestre')
                ->join('ciclos', 'calificaciones.idCiclo', '=', 'ciclos.id')
                ->where('ciclos.id', '=', $idCiclo)
                ->where('alumnos.id', '=', $criterio)
                ->where('bimestres.id', '=', $idBimestre)
                ->where('alumnos.condicion', '=', '1')
                ->select('alumnos.id','calificaciones.id as idCalificacion', 'calificaciones.calificacion as calificaciones', 'calificaciones.calificacion', 'detalle_calificaciones.observaciones as observacion', 'detalle_calificaciones.observaciones',
                'materias.nombre as nombreMateria')
                ->orderBy('nombreMateria', 'asc')->paginate(10);    

            return [
                
                'pagination'=> [
                    'total'         =>  $alumnos ->total(),
                    'current_page'  =>  $alumnos ->currentPage(),
                    'per_page'      =>  $alumnos ->perPage(),
                    'last_page'     =>  $alumnos ->lastPage(),
                    'from'          =>  $alumnos ->firstItem(),
                    'to'            =>  $alumnos ->lastItem(),
                ],
                
                'calificacion'=> $alumnos
            ];
        }
    }

    public function pdfVerCalificaciones($criterio, $idCiclo, $idBimestre)
    {
        $alumno = Alumno::join('personas', 'alumnos.idPersona', 'personas.id')->where('alumnos.id', $criterio)->select('personas.*')->first();
        $ciclo = Ciclo::where('id', '=', $idCiclo)->first();
       
        $bimestre = Bimestre::findOrFail($idBimestre)->first();
        $fechaimpresion = date('d/M/Y');
        $horaimpresion = date('h:i:s');

            $alumnos = calificacione::join('detalle_calificaciones', 'calificaciones.id', '=', 'detalle_calificaciones.idCalificacion')
            ->join('alumnos', 'alumnos.id', '=', 'calificaciones.idAlumno')
            ->join('materias', 'materias.id', '=', 'calificaciones.idMateria')
            ->join('bimestres', 'bimestres.id', '=', 'calificaciones.idBimestre')
            ->join('ciclos', 'calificaciones.idCiclo', '=', 'ciclos.id')
            ->where('ciclos.id', '=', $idCiclo)
            ->where('alumnos.id', '=', $criterio)
            ->where('bimestres.id', '=', $idBimestre)
            ->where('alumnos.condicion', '=', '1')
            ->select('calificaciones.calificacion as calificaciones', 'detalle_calificaciones.observaciones as observacion',
            'materias.nombre as nombreMateria')
            ->orderBy('materias.nombre', 'asc')->get();    
        
        $pdf = \PDF::loadView('pdf.lsitadoalumnoscalificacion', compact('alumno', 'ciclo', 'bimestre', 'alumnos', 'fechaimpresion', 'horaimpresion'));
        return $pdf->download($alumno->nombre.' '.$alumno->apellido.'-'.date('d-m-Y').'.pdf');
    }
    

    public function buscarAlumno(Request $request)
    {
        $idGrado=$request->idGrado;
        $idCiclo=$request->idCiclo;
        $idDocente = $request->idDocente;
        $alumnos = Asignar_docente::join('asignar_materia', 'asignar_docente.idMateria','asignar_materia.idMateria')
        ->join('asignar_alumnos', 'asignar_alumnos.idGrado','asignar_materia.idGrado')
        ->join('alumnos', 'asignar_alumnos.idAlumno', '=', 'alumnos.id')
        ->join('personas','personas.id','=','alumnos.idPersona')
        ->where('asignar_docente.idDocente','=', $idDocente)
        ->where('asignar_alumnos.idGrado', '=', $idGrado)
        ->where('asignar_alumnos.idCiclo', '=', $idCiclo)
        ->select('alumnos.id as id', DB::raw('CONCAT(personas.nombre, " ", personas.apellido, " / ", personas.identificacion) as nombre'))
        ->groupBy('id', 'nombre')
        ->orderBy('nombre', 'asc')->get();    
        
        return [
            'alumno'=> $alumnos
        ];

    }
    public function buscarMateria(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $id= $request->id;
        $criterio= $request->criterio;
        $idCiclo= $request->idCiclo;
        

        $alumnos = Asignar_docente::join('personas', 'idDocente', '=', 'personas.id')
        ->join('materias','asignar_docente.idMateria','=','materias.id')
        ->join('asignar_materia','materias.id','=','asignar_materia.idMateria')
        ->join('grados','asignar_materia.idGrado','=','grados.id')
        ->join('secciones','grados.idSeccion','=','secciones.id')
        ->join('niveles','grados.idNivel','=','niveles.id')
        ->join('ciclos', 'asignar_docente.idCiclo', '=','ciclos.id')
        ->where('asignar_docente.estado','=','1')
        ->where('niveles.id', '=', $criterio)
        ->where('asignar_docente.idDocente', '=', $id)
        ->where('personas.estado','=','1')
        ->where('materias.estado','=','1')
        ->where('asignar_docente.idCiclo', '=', $idCiclo)
        ->select('materias.id as id', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", secciones.nombre) as nombre'))
        ->orderBy('nombre', 'asc')->get();    
        
        return [
            'materia'=> $alumnos
        ];
    }
    public function filtroAlumno(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        
        $id= $request->id;
        $date = Carbon::now();
        $date = $date->format('Y');
        

        $alumnos = Asignar_padre_alumno::join('personas', 'asignar_padre_alumnos.idPersona', '=', 'personas.id')
        ->join('alumnos','alumnos.id','=','asignar_padre_alumnos.idAlumno')
        ->join('personas as prsn', 'prsn.id','=','alumnos.idPersona')
        ->join('ciclos', 'asignar_padre_alumnos.idCiclo','=', 'ciclos.id')
        ->where('personas.id','=',$id)
        ->where('ciclos.nombre', '=', $date)
        ->where('asignar_padre_alumnos.estado','=','1')
        ->select('alumnos.id', DB::raw('CONCAT(prsn.nombre, " ", prsn.apellido, " / ", prsn.identificacion) as nombre'))
        ->orderBy('nombre', 'asc')->get();    
        
        return [
            'Alumnos'=> $alumnos
        ];
    }

    public function buscarBimestre(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
               
        $alumnos = Bimestre::select('id', 'nombre')->orderBy('id', 'asc')->get();    
               
        return [
            'bimestre'=> $alumnos
        ];
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (!$request->ajax()) return redirect('/');
            try{
                DB::beginTransaction();    
                $notas = new calificacione();
                $notas -> idMateria = $request->idMateria;
                $notas -> idDocente = $request->idDocente;
                $notas -> idBimestre = $request->idBimestre;
                $notas -> idAlumno = $request->idAlumno;
                $notas -> idCiclo = $request->idCiclo;
                $notas -> calificacion = $request->calificacion;
                $notas -> save();

                $detalleNotas = new detalle_calificacione();
                $detalleNotas -> idCalificacion = $notas->id;
                $detalleNotas -> conducta = $request->conducta;
                $detalleNotas -> asistencia= $request->asistencia;
                $detalleNotas -> uniforme = $request->uniforme;
                $detalleNotas -> actividades = $request->actividades;
                $detalleNotas -> colaboracion = $request->colaboracion;
                $detalleNotas -> examen = $request->examen;
                $detalleNotas -> observaciones = $request->observaciones;
                $detalleNotas -> save();

            
                DB::commit();

            }
            catch (Exeption $e)
            {
                DB::rollBack();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
