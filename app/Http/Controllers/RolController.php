<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Rol;


class RolController extends Controller
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
            $rols = Rol::orderBy('id', 'asc')->paginate(6);
        }
        else{
            $rols = Rol::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }
        return [
            'pagination'=> [
                'total'         =>  $rols ->total(),
                'current_page'  =>  $rols ->currentPage(),
                'per_page'      =>  $rols ->perPage(),
                'last_page'     =>  $rols ->lastPage(),
                'from'          =>  $rols ->firstItem(),
                'to'            =>  $rols ->lastItem(),
            ],
            'rols'=>$rols
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
        if (!$request->ajax()) return redirect('/');
        //
        
        $rol = new Rol();
        $rol -> nombre = $request->nombre;
        $rol -> descripcion = $request->descripcion;
        $rol -> estado= '1';
        $rol -> save();
    }

    public function selectRol(Request $request)
    {
        $select=Rol::where('estado','=','1')
        ->select('id','nombre')
        ->orderby('nombre','asc')->get();

        return ['rols' => $select];
    }
   
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $rol =  Rol::findOrFail($request->id);
        $rol -> nombre = $request->nombre;
        $rol -> descripcion = $request->descripcion;
        $rol -> estado= '1';
        $rol -> save();
    }


    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $rol =  Rol::findOrFail($request->id);
        $rol -> estado = '0';
        $rol -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $rol =  Rol::findOrFail($request->id);
        $rol -> estado = '1';
        $rol -> save();
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
