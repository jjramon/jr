<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Carrera;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar ==''){
            $select = Carrera::orderBy('id', 'asc')->paginate(8);
        }
        else{
            $select = Carrera::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','asc')->paginate(3);
        }
        
        return [
            'pagination'=> [
                'total'         =>  $select ->total(),
                'current_page'  =>  $select->currentPage(),
                'per_page'      =>  $select->perPage(),
                'last_page'     =>  $select ->lastPage(),
                'from'          =>  $select ->firstItem(),
                'to'            =>  $select ->lastItem(),
            ],
            'carrera'=>$select
        ];
    }
    public function selectCarrera(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $select = Carrera::where('estado', '=', '1')
        ->select('id', 'nombre')->orderBy('nombre','asc')->get();
        return ['carrera'=> $select];
       
        
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
        
        $insert = new Carrera();
        $insert -> nombre = $request->nombre;
        $insert -> estado= '1';
        $insert -> save();
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
        $update =  Carrera::findOrFail($request->id);
        $update-> nombre = $request->nombre;
        $update -> estado= '1';
        $update -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $down =  Carrera::findOrFail($request->id);
        $down -> estado = '0';
        $down -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $up =  Carrera::findOrFail($request->id);
        $up -> estado = '1';
        $up -> save();
    }
}
