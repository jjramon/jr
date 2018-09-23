<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Materia;
class MateriaController extends Controller
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
            $select = Materia::orderBy('id', 'asc')->paginate(8);
        }
        else{
            $select = Materia::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','asc')->paginate(3);
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
            'dias'=>$select
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
        
        $insertar = new Materia();
        $insertar -> nombre = $request->nombre;
        $insertar -> estado= '1';
        $insertar -> save();
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
        $actualizar = Materia::findOrFail($request->id);
        $actualizar-> nombre = $request->nombre;
        $actualizar -> estado= '1';
        $actualizar -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $desactivar =  Materia::findOrFail($request->id);
        $desactivar -> estado = '0';
        $desactivar -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $activar =  Materia::findOrFail($request->id);
        $activar -> estado = '1';
        $activar -> save();
    }

    

}
