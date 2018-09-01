<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Horario;

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
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar ==''){
            $horarios = Horario::join('dias','horarios.idDia','=','dias.id')
            ->select ('horarios.id','horarios.horario', 'horarios.horario_salida', 'horarios.idDia', 'dias.nombre as nombre_dia', 'dias.estado')
            ->orderBy('horarios.id', 'desc')->paginate(8);
        }
        else{
            $horarios = Horario::join('dias','horarios.idDia','=','dias.id')
            ->select ('horarios.id','horarios.horario', 'horarios.horario_salida', 'horarios.idDia', 'dias.nombre as nombre_dia', 'dias.estado')
            ->where('horarios.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('horarios.id', 'desc')->paginate(3);
            
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
