<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Persona;
use colegioShaddai\Tipo_persona;
use colegioShaddai\Genero;

class PersonaController extends Controller
{
    
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        

      
        if($buscar == '' && $criterio=='')
            {
                $personas = Persona::join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
                ->join('generos', 'idGenero', '=', 'generos.id')
                ->where('personas.estado','=', '1')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')
                ->where('tipo_personas.nombre','!=',"Alumno")           
                ->select('personas.id', 'personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado')
                ->orderBy('tipo_personas.id', 'asc')->paginate(10);         
            }
        if($criterio != '' && $buscar == '')
            {
                $personas = Persona::join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
                ->join('generos', 'idGenero', '=', 'generos.id')
                ->where('personas.estado','=', '1')
                ->where('tipo_personas.estado','=', '1')
                ->where('generos.estado','=', '1')
                ->where('tipo_personas.id','=', $criterio)           
                ->select('personas.id', 'personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado')
                ->orderBy('tipo_personas.id', 'asc')->paginate(10);         
            } 
        if($criterio != '' && $buscar != '')
        {
               
            $personas = Persona::join('tipo_personas','personas.idTipoPersona','=','tipo_personas.id')
            ->join('generos', 'idGenero', '=', 'generos.id')
            ->where('personas.estado','=', '1')
            ->where('tipo_personas.estado','=', '1')
            ->where('generos.estado','=', '1')
            ->where('personas.apellido','like','%'.$buscar.'%')
            ->orwhere('personas.nombre','like','%'.$buscar.'%')
            ->where('tipo_personas.id','like', $criterio)
            ->select('personas.id', 'personas.nombre', 'personas.apellido', 'generos.genero as nombreGenero', 'personas.identificacion', 'tipo_personas.nombre as nombreTPersona', 'personas.direccion', 'personas.tel', 'personas.tel2', 'personas.correo', 'personas.estado')
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
    
    public function selectTipoPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $tipo_persona = Tipo_persona::where('estado', '=', '1')->where('nombre', '!=', "Alumno")
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

            
        $persona = new Persona();
        $persona -> idGenero = $request->idGenero;
        $persona -> idTipoPersona = $request->idTipoPersona;
        $persona -> nombre = $request->nombre;
        $persona -> apellido = $request->apellido;
        $persona -> identificacion = $request->identificacion;
        $persona -> direccion = $request->direccion;
        $persona -> tel = $request->tel;
        $persona -> tel2 = $request->tel2;
        $persona -> correo = $request->correo;
        $persona -> estado= '1';
        $persona -> save();
    }
    
    
    public function update(Request $request)
    {

        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->id);
            $persona -> idGenero = $request->idGenero;
            $persona -> idTipoPersona = $request->idTipoPersona;
            $persona -> nombre = $request->nombre;
            $persona -> apellido = $request->apellido;
            $persona -> identificacion = $request->identificacion;
            $persona -> direccion = $request->direccion;
            $persona -> tel = $request->tel;
            $persona -> tel2 = $request->tel2;
            $persona -> correo = $request->correo;
            $persona -> estado= '1';
            $persona -> save();
    }
    
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->id);
            $persona -> estado = '0';
            $persona -> save();
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
            $persona =  Persona::findOrFail($request->id);
            $persona -> estado = '1';
            $persona -> save();
    }

}    
