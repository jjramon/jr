<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Tipo_persona;


class Tipo_personaController extends Controller
{
    public function index(Request $request)
    {
        //
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar ==''){
            $tipo_personas = Tipo_persona::orderBy('nombre', 'asc')->paginate(8);
        }
        else{
            $tipo_personas = Tipo_persona::where($criterio, 'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(3);
        }
        
        return [
            'pagination'=> [
                'total'         =>  $tipo_personas ->total(),
                'current_page'  =>  $tipo_personas->currentPage(),
                'per_page'      =>  $tipo_personas->perPage(),
                'last_page'     =>  $tipo_personas ->lastPage(),
                'from'          =>  $tipo_personas ->firstItem(),
                'to'            =>  $tipo_personas ->lastItem(),
            ],
            'tipo_personas'=>$tipo_personas
        ];
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
        //
        
        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = $request->nombre;
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if (!$request->ajax()) return redirect('/');
        //
        $tipo_persona =  Tipo_persona::findOrFail($request->id);
        $tipo_persona-> nombre = $request->nombre;
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $tipo_persona =  Tipo_persona::findOrFail($request->id);
        $tipo_persona -> estado = '0';
        $tipo_persona -> save();
    }
    public function selectTipoPersona(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $tipo_persona = Tipo_persona::where('estado', '=', '1')->where('nombre', '!=', "Alumno")
        ->select('id', 'nombre')->orderBy('nombre','asc')->get();
        return ['tipo_persona'=> $tipo_persona];
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $tipo_persona =  Tipo_persona::findOrFail($request->id);
        $tipo_persona -> estado = '1';
        $tipo_persona -> save();
}



}
