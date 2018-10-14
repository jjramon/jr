<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Persona;
use colegioShaddai\Alumno;
use colegioShaddai\Tipo_persona;
use colegioShaddai\Genero;
use colegioShaddai\Asignar_alumno;
use colegioShaddai\Asignar_padre_alumno;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
              
        if($buscar == '' && $criterio=='')
            {
                
                $leer = Alumno::join('personas', 'alumnos.idPersona', '=', 'personas.id')
                ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
                ->join('generos', 'personas.idGenero', '=', 'generos.id')
                ->join('asignar_padre_alumnos', 'alumnos.id', '=', 'asignar_padre_alumnos.idAlumno')
                ->join('personas as padres', 'asignar_padre_alumnos.idPersona','=','padres.id')
                ->join('asignar_alumnos', 'alumnos.id', '=', 'asignar_alumnos.idAlumno')
                ->join('grados', 'asignar_alumnos.idGrado','=','grados.id')
                ->join('niveles', 'niveles.id','=','grados.idNivel')
                ->join('secciones', 'secciones.id','=','grados.idSeccion')
                ->join('carreras', 'carreras.id','=','grados.idCarrera')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')
                ->where('grados.estado','=','1')
                ->where('asignar_padre_alumnos.estado', '=', '1')
                ->select('asignar_alumnos.id as idAsignacionGrado','secciones.id as idSeccion','carreras.id as idCarrera','niveles.id as idNivel','grados.id as idGrado',
                'generos.id as idGenero','tipo_personas.id as idTipoPersona', 'alumnos.id as idAlumno', 'personas.id as idPersona',
                'padres.id as idPadre', 'asignar_padre_alumnos.id as idAisgPadreAlumno','padres.nombre as nombrePadre','padres.apellido as apellidoPadre', 
                'padres.identificacion as identificacionPadre', 'padres.direccion as direccionPadre', 'padres.tel as telPadre',
                'personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 
                'tipo_personas.nombre as nombreTipoPersona', 'grados.nombre as nombreGrado','niveles.nombre as nombreNivel',
                'carreras.nombre as nombreCarrera','secciones.nombre as nombreSeccion','alumnos.fechaNacimiento as fechaNac',
                'personas.estado')
                ->orderBy('personas.apellido', 'asc')->paginate(10);  

            }
        if($buscar == '' && $criterio !='')
            {
                $leer = Alumno::join('personas', 'idPersona', '=', 'personas.id')
                ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
                ->join('generos', 'personas.idGenero', '=', 'generos.id')
                ->where('personas.estado','=', '1')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')
                ->where('tipo_personas.id','like', $criterio)           
                ->select('alumnos.id as idAlumno', 'personas.id as idPersona','personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'alumnos.fechaNacimiento as fechaNac',  'personas.estado')
                ->orderBy('tipo_personas.id', 'asc')->paginate(10);         
            }       
        /*if($criterio != '' && $buscar != '')
        {
               
            $leer = Alumno::join('personas', 'idPersona', '=', 'personas.id')
            ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
            ->join('generos', 'personas.idGenero', '=', 'generos.id')
            ->where('personas.estado','=', '1')
            ->where('tipo_personas.estado','=', '1')
            ->where('generos.estado','=', '1')
            ->where('tipo_personas.id','like', "Alumno")
            ->where('personas.apellido','like','%'.$buscar.'%')
            ->orwhere('personas.nombre','like','%'.$buscar.'%')
            //->where('tipo_personas.id','like', $criterio)
            ->select('alumnos.id as idAlumno', 'personas.id as idPersona','personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'alumnos.fechaNacimiento as fechaNac',  'personas.estado')
            ->orderBy('personas.apellido', 'asc')->paginate(10);
            
        }
*/
        return [
            'pagination'=> [
                'total'         =>  $leer ->total(),
                'current_page'  =>  $leer ->currentPage(),
                'per_page'      =>  $leer ->perPage(),
                'last_page'     =>  $leer ->lastPage(),
                'from'          =>  $leer ->firstItem(),
                'to'            =>  $leer ->lastItem(),
            ],
            'alumno'=>$leer
        ];
    }
    
    
    public function selectTipoPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $tipo_persona = Tipo_persona::where('estado', '=', '1')->where('nombre', '=', "Alumno")
        ->select('id', 'nombre')->orderBy('nombre','asc')->get();
        return ['tipo_persona'=> $tipo_persona];
    }

    public function selectGenero(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $genero = Genero::where('estado', '=', '1')
        ->select('id', 'genero')->orderBy('genero','asc')->get();
        return ['genero'=> $genero];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona -> idGenero = $request->idGenero;
            $persona -> idTipoPersona = $request->idTipoPersona;
            $persona -> nombre = $request->nombre;
            $persona -> apellido = $request->apellido;
            $persona -> identificacion = $request->identificacion;
            $persona -> save();

            $alumno = new Alumno();
            $alumno -> fechaNacimiento = $request->fechaNac;
            $alumno -> idPersona = $persona ->id;
            $alumno -> save();    
            
            $asignar = new Asignar_alumno();
            $asignar -> idAlumno = $alumno ->id;
            $asignar -> idGrado = $request->idGrado;
            $asignar -> estado = '1';
            $asignar-> save();

            $asigPadre = new Asignar_padre_alumno();
            $asigPadre -> idAlumno = $alumno->id;
            $asigPadre -> idPersona = $request->idPadre;
            $asigPadre -> save();
            DB::commit();

        }
        catch (Exeption $e)
        {
            DB::rollBack();
        }
    }
    
    
    public function update(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $actualizar = Persona::findOrFail($request->idPersona);
            $actualizar -> idGenero = $request->idGenero;
            $actualizar -> idTipoPersona = $request->idTipoPersona;
            $actualizar -> nombre = $request->nombre;
            $actualizar -> apellido = $request->apellido;
            $actualizar -> identificacion = $request->identificacion;
            $actualizar -> estado= '1';
            $actualizar -> save();

            $actualiza = Alumno::findOrFail($request->idAlumno);
            $actualiza -> fechaNacimiento = $request->fechaNacimiento;
            $actualiza -> save();

            $actualAsignar = Asignar_alumno::findOrFail($request->idAsigAlumnoGrado);
            $actualAsignar -> idAlumno = $request->idAlumno;
            $actualAsignar -> idGrado = $request->idGrado;
            $actualAsignar -> estado = '1';
            $actualAsignar-> save();

            $actualizarAsigPadre = Asignar_padre_alumno::findOrFail($request->idAsigPadreAlumno);
            $actualizarAsigPadre -> idAlumno = $request->idAlumno;
            $actualizarAsigPadre -> idPersona = $request->idPadre;
            $actualizarAsigPadre -> save();

            DB::commit();

        }
        catch (Exeption $e)
        {
            DB::rollBack();
        }
    }
    
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $desactivar = Persona::findOrFail($request->idPersona);
            $desactivar -> estado= '0';
            $desactivar -> save();

            DB::commit();

        }
        catch (Exeption $e)
        {
            DB::rollBack();
        }
            
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $activar = Persona::findOrFail($request->idPersona);
            $activar -> estado= '1';
            $activar -> save();

            DB::commit();

        }
        catch (Exeption $e)
        {
            DB::rollBack();
        }
    }
}
