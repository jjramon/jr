<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\User;
use colegioShaddai\Tipo_persona;

class UserController extends Controller
    {
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

    
        if($buscar == '' && $criterio=='')
            {
                
                $leer = User::join('personas', 'idPersona', '=', 'personas.id')
                ->join('rols', 'users.idRol', '=', 'rols.id')
                ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
                ->where('personas.estado','=', '1')
                ->where('rols.estado','=', '1')
                ->where('personas.estado','=','1')   
                ->select('personas.id as idPersona','personas.nombre', 'personas.apellido',  'tipo_personas.nombre as nombreTPersona', 'users.estado','users.id as idUser', 'users.usuario','users.password','persona.estado as estadoPersona','rols.estado as estadoRols', 'rols.nombre as nombreRol')
                ->orderBy('personas.apellido', 'asc')->paginate(10);  

            }
        if($buscar == '' && $criterio !='')
            {
                $leer = User::join('personas', 'idPersona', '=', 'personas.id')
                ->join('rols', 'users.idRol', '=', 'rols.id')
                ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
                ->where('personas.estado','=', '1')
                ->where('rols.estado','=', '1')
                ->where('rols.id','like', $criterio)           
                ->select('personas.id as idPersona','personas.nombre', 'personas.apellido',  'tipo_personas.nombre as nombreTPersona', 'users.estado','users.id as idUser', 'users.usuario','users.password','persona.estado as estadoPersona','rols.estado as estadoRols', 'rols.nombre as nombreRol')                
                ->orderBy('rols.id', 'asc')->paginate(10);         
            }        
        if($criterio != '' && $buscar != '')
        {
            
            $leer = User::join('personas', 'idPersona', '=', 'personas.id')
            ->join('rols', 'users.idRol', '=', 'rols.id')
            ->join('tipo_personas', 'personas.idTipoPersona', '=', 'tipo_personas.id')
            ->where('personas.estado','=', '1')
            ->where('rols.estado','=', '1')
            ->where('personas.apellido','like','%'.$buscar.'%')
            ->orwhere('personas.nombre','like','%'.$buscar.'%')
            ->select('personas.id as idPersona','personas.nombre', 'personas.apellido',  'tipo_personas.nombre as nombreTPersona', 'users.estado','users.id as idUser', 'users.usuario','users.password','persona.estado as estadoPersona','rols.estado as estadoRols', 'rols.nombre as nombreRol')            
            ->orderBy('personas.apellido', 'asc')->paginate(10);
            
        }

        return [
            'pagination'=> [
                'total'         =>  $leer ->total(),
                'current_page'  =>  $leer ->currentPage(),
                'per_page'      =>  $leer ->perPage(),
                'last_page'     =>  $leer ->lastPage(),
                'from'          =>  $leer ->firstItem(),
                'to'            =>  $leer ->lastItem(),
            ],
            'persona'=>$leer
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
            $insertar = new Persona();
            $insertar -> idGenero = $request->idGenero;
            $insertar -> idTipoPersona = $request->idTipoPersona;
            $insertar -> nombre = $request->nombre;
            $insertar -> apellido = $request->apellido;
            $insertar -> identificacion = $request->identificacion;
            $insertar -> estado= '1';
            $insertar -> save();

            $insert = new Alumno();
            $insert -> fechaNacimiento = $request->fechaNacimiento;
            $insert -> idPersona = $insertar -> id;
            $insert -> save();

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