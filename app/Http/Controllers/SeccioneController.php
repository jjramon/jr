<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Seccione;

class SeccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar ==''){
            $dias = Seccione::orderBy('nombre', 'asc')->paginate(8);
        }
        else{
            $dias = Seccione::where($criterio, 'like', '%'.$buscar.'%')->orderBy('nombre','asc')->paginate(3);
        }
        
        return [
            'pagination'=> [
                'total'         =>  $dias ->total(),
                'current_page'  =>  $dias->currentPage(),
                'per_page'      =>  $dias->perPage(),
                'last_page'     =>  $dias ->lastPage(),
                'from'          =>  $dias ->firstItem(),
                'to'            =>  $dias ->lastItem(),
            ],
            'dias'=>$dias
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
        
        $dia = new Seccione();
        $dia -> nombre = $request->nombre;
        $dia -> estado= '1';
        $dia -> save();
    }

    public function selectSeccion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $select = Seccione::where('estado','=','1')
        ->select('id', 'nombre')
        ->orderBy('id','asc')->get();
        return ['seccion'=> $select];
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
        $dia =  Seccione::findOrFail($request->id);
        $dia-> nombre = $request->nombre;
        $dia -> estado= '1';
        $dia -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $dia =  Seccione::findOrFail($request->id);
        $dia -> estado = '0';
        $dia -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $dia =  Seccione::findOrFail($request->id);
        $dia -> estado = '1';
        $dia -> save();
    }

    

}
