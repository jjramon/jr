<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Horario;
use colegioShaddai\Dia;

class HorarioController extends Controller
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
       
        if ($buscar ==''){
            $horarios = Horario::join('dias','horarios.idDia','=','dias.id')
            ->select ('horarios.id','horarios.horario', 'horarios.horario_salida', 'horarios.idDia', 'dias.nombre as nombre_dia', 'horarios.estado')
            ->where('dias.estado','=', '1')
            ->orderBy('horarios.id', 'asc')->paginate(8);
        }
        else{
            $horarios = Horario::join('dias','horarios.idDia','=','dias.id')
            ->select ('horarios.id','horarios.horario', 'horarios.horario_salida', 'horarios.idDia', 'dias.nombre as nombre_dia', 'dias.estado')
            ->where('horarios.idDia', 'like', $buscar)
            ->orderBy('horarios.horario', 'asc')->paginate(3);
            
        }
        
        return [
            'pagination'=> [
                'total'         =>  $horarios ->total(),
                'current_page'  =>  $horarios->currentPage(),
                'per_page'      =>  $horarios->perPage(),
                'last_page'     =>  $horarios ->lastPage(),
                'from'          =>  $horarios ->firstItem(),
                'to'            =>  $horarios ->lastItem(),
            ],
            'horarios'=>$horarios
        ];
    }

    public function selectDia(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
        $dias = Dia::where('estado', '=', '1')
        ->select('id', 'nombre')->orderBy('id','asc')->get();
        return ['dias'=> $dias];
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
        
        $horario = new Horario();
        $horario -> horario = $request->horario;
        $horario -> horario_salida = $request->horario_salida;
        $horario -> idDia = $request->idDia;
        $horario -> estado= '1';
        $horario -> save();
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
        $horario =  Horario::findOrFail($request->id);
        $horario -> horario = $request->horario;
        $horario -> horario_salida = $request->horario_salida;
        $horario -> idDia = $request->idDia;
        $horario -> estado= '1';
        $horario -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $horario =  Horario::findOrFail($request->id);
        $horario -> estado = '0';
        $horario -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $horario =  Horario::findOrFail($request->id);
        $horario -> estado = '1';
        $horario -> save();
    }

}
