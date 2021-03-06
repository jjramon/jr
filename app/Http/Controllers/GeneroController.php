<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Genero;


class GeneroController extends Controller
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
            $generos = Genero::orderBy('id', 'desc')->paginate(6);
        }
        else{
            $generos = Genero::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }
        
        return [
            'pagination'=> [
                'total'         =>  $generos ->total(),
                'current_page'  =>  $generos ->currentPage(),
                'per_page'      =>  $generos ->perPage(),
                'last_page'     =>  $generos ->lastPage(),
                'from'          =>  $generos ->firstItem(),
                'to'            =>  $generos ->lastItem(),
            ],
            'generos'=>$generos
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
        $genero = new Genero();
        $genero -> genero = $request->genero;
        $genero -> estado = '1';
        $genero -> save();
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
        if (!$request->ajax()) return redirect('/');
        //
        $genero =  Genero::findOrFail($request->id);
        $genero -> genero = $request->genero;
        $genero -> estado = '1';
        $genero -> save();
    }
    public function selectGenero(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $genero = Genero::where('estado', '=', '1')
        ->select('id', 'genero')->orderBy('genero','asc')->get();
        return ['genero'=> $genero];
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $genero =  Genero::findOrFail($request->id);
        $genero -> estado = '0';
        $genero -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $rol =  Genero::findOrFail($request->id);
        $rol -> estado = '1';
        $rol -> save();
    }
   
}
