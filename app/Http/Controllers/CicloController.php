<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Ciclo;

class CicloController extends Controller
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
            $ciclos = Ciclo::orderBy('id', 'desc')->paginate(8);
        }
        else{
            $ciclos = Ciclo::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }
        
        return [
            'pagination'=> [
                'total'         =>  $ciclos ->total(),
                'current_page'  =>  $ciclos ->currentPage(),
                'per_page'      =>  $ciclos ->perPage(),
                'last_page'     =>  $ciclos ->lastPage(),
                'from'          =>  $ciclos ->firstItem(),
                'to'            =>  $ciclos ->lastItem(),
            ],
            'ciclos'=>$ciclos
        ];
    }

    public function selectCiclo(Request $request)
    {
        $select = Ciclo::orderBy('id', 'asc')->get();
        return ['ciclo'=> $select];
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
        
        $ciclo = new Ciclo();
        $ciclo -> nombre = $request->nombre;
        $ciclo -> estado= '1';
        $ciclo -> save();
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
        $ciclo =  Ciclo::findOrFail($request->id);
        $ciclo -> nombre = $request->nombre;
        $ciclo -> estado= '1';
        $ciclo -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $ciclo =  Ciclo::findOrFail($request->id);
        $ciclo -> estado = '0';
        $ciclo -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $ciclo =  Ciclo::findOrFail($request->id);
        $ciclo -> estado = '1';
        $ciclo -> save();
    }



}
