<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Persona;
use colegioShaddai\User;
use Illuminate\Support\Facades\DB;
use  Jenssegers \ Date \ Date ;
use Carbon\Carbon;

class PersonaController extends Controller
{
    
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

      
        if($buscar == '' && $criterio=='')
            {
                $personas = Persona::join('users', 'personas.id', '=', 'users.idPersona')
                ->join('rols','users.idRol', '=', 'rols.id')
                ->join('generos', 'personas.idGenero', '=', 'generos.id')
                ->join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
                ->where('rols.estado','=', '1')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')  
                ->where('tipo_personas.nombre','!=', "Alumno")         
                ->select('personas.id as idPersona', 'users.id as idUsuario','users.usuario', 'users.password','users.estado as usuarioEstado','rols.id as idRol','rols.nombre as nombreRol','personas.nombre as nombrePersona', 'personas.apellido', 'generos.genero as nombreGenero', 'generos.id as idGenero', 'personas.identificacion','tipo_personas.id as idTipoPersona', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado as estadoPersona')
                ->orderBy('tipo_personas.id', 'asc')->paginate(10);   
            }
        if($criterio != '' && $buscar == '')
            {
                $personas = Persona::join('users', 'personas.id', '=', 'users.idPersona')
                ->join('rols','users.idRol', '=', 'rols.id')
                ->join('generos', 'personas.idGenero', '=', 'generos.id')
                ->join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
                ->where('rols.estado','=', '1')
                ->where('users.estado','=', '1')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')    
                ->where('tipo_personas.id','=', $criterio)         
                ->select('personas.id', 'users.id as idUsuario','users.usuario', 'users.password','users.estado as idEstado','rols.id','rols.nombre as nombreRol','personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado')
                ->orderBy('tipo_personas.id', 'asc')->paginate(10);         
            } 
        if($criterio != '' && $buscar != '')
        {
               
            $personas = Persona::join('users', 'personas.id', '=', 'users.idPersona')
            ->join('rols','users.idRol', '=', 'rols.id')
            ->join('generos', 'personas.idGenero', '=', 'generos.id')
            ->join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
            ->where('rols.estado','=', '1')
            ->where('users.estado','=', '1')
            ->where('tipo_personas.estado','=', '1')
            ->where('generos.estado','=', '1')    
            ->where('personas.apellido','like','%'.$buscar.'%')
            ->orwhere('personas.nombre','like','%'.$buscar.'%')
            ->where('tipo_personas.id','like', $criterio)
            ->select('personas.id', 'users.id as idUsuario','users.usuario', 'users.password','users.estado as idEstado','rols.id as idRol','rols.nombre as nombreRol','personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado')
            ->orderBy('personas.apellido', 'asc')->paginate(10);
            
        }

        return [
            'pagination'=> [
                'total'         =>  $personas ->total(),
                'current_page'  =>  $personas ->currentPage(),
                'per_page'      =>  $personas ->perPage(),
                'last_page'     =>  $personas ->lastPage(),
                'from'          =>  $personas ->firstItem(),
                'to'            =>  $personas ->lastItem(),
            ],
            'persona'=>$personas
        ];
    }
    
    

    

    public function store(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
            try{
                DB::beginTransaction();    
                $persona = new Persona();
                $persona -> idGenero = $request->idGenero;
                $persona -> idTipoPersona = $request->idTipoPersona;
                $persona -> nombre = $request->nombrePersona;
                $persona -> apellido = $request->apellido;
                $persona -> identificacion = $request->identificacion;
                $persona -> direccion = $request->direccion;
                $persona -> tel = $request->tel;
                $persona -> tel2 = $request->tel2;
                $persona -> correo = $request->correo;
                $persona -> save();

                $usuario = new User();
                $usuario -> idPersona = $persona->id;
                $usuario -> idRol = $request->idRol;
                $usuario -> usuario = $request->usuario;
                $usuario -> password = bcrypt($request->password);
                $usuario -> save();

            
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
            $actualizar -> nombre = $request->nombrePersona;
            $actualizar -> apellido = $request->apellido;
            $actualizar -> identificacion = $request->identificacion;
            $actualizar -> direccion = $request->direccion;
            $actualizar -> tel = $request->tel;
            $actualizar -> tel2 = $request->tel2;
            $actualizar -> correo = $request->correo;
            $actualizar -> save();

            $usuario = User::findOrFail($request->idUsuario); 
            $usuario -> idPersona = $actualizar->id;
            $usuario -> idRol = $request->idRol;
            $usuario -> usuario = $request->usuario;
            $usuario -> password = bcrypt($request->password);
            $usuario -> save();

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
            $persona =  Persona::findOrFail($request->idPersona);
            $persona -> estado = '0';
            $persona -> save();

            $usuario = User::findOrFail($request->idUsuario);
            $usuario -> estado = '0';
            $usuario -> save();
    }
    
    public function desactivarPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->idPersona);
            $persona -> estado = '0';
            $persona -> save();

            
    }
    
    public function desactivarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $usuario = User::findOrFail($request->idUsuario);
            $usuario -> estado = '0';
            $usuario -> save();
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->idPersona);
            $persona -> estado = '1';
            $persona -> save();

            $usuario = User::findOrFail($request->idUsuario);
            $usuario -> estado = '1';
            $usuario -> save();
    }
    public function activarPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->idPersona);
            $persona -> estado = '1';
            $persona -> save();
    }
    public function activarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $usuario = User::findOrFail($request->idUsuario);
            $usuario -> estado = '1';
            $usuario -> save();
    }

}    
