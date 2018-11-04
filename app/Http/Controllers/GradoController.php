<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Grado;


class GradoController extends Controller
{
    public function index(Request $request)
    {
        //
        //if (!$request->ajax()) return redirect('/');
        $criterio = $request->criterio;
        $buscar = $request->buscar;
        if ($criterio != 4){
            $select = Grado::join('niveles','grados.idNivel','=','niveles.id')
            ->join('secciones','grados.idSeccion','=','secciones.id')
            ->where('secciones.estado','=','1')
            ->where('niveles.estado','=','1')
            ->where('grados.idNivel', '=', $criterio)
            ->select('grados.id as idGrado', 'niveles.id as idNivel',
            'secciones.id as idSeccion','grados.nombre as nombreGrado','niveles.nombre as nombreNivel', 
            'secciones.nombre as nombreSeccion',  'grados.estado as estadoGrado')
            ->orderBy('grados.id', 'asc')->paginate(8);
        }
        else{
            $select = Grado::join('niveles','grados.idNivel','=','niveles.id')
            ->join('secciones','grados.idSeccion','=','secciones.id')
            ->join('carreras','grados.idCarrera','=','carreras.id')
            ->where('secciones.estado','=','1')
            ->where('niveles.estado','=','1')
            ->where('grados.idNivel', '=', $criterio)
            ->where('carreras.id', '=', $buscar)
            ->select('grados.id as idGrado', 'carreras.id as idCarrera','niveles.id as idNivel',
            'secciones.id as idSeccion','grados.nombre as nombreGrado','niveles.nombre as nombreNivel', 
            'secciones.nombre as nombreSeccion', 'carreras.nombre as nombreCarrera', 'grados.estado as estadoGrado')
            ->orderBy('niveles.id', 'asc')->paginate(8);
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
            'grado'=>$select
        ];
    }
    public function selectGrado(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');
        $filtro=$request->filtro;
        if($filtro != 4)
        {
            $grado=Grado::join('secciones','grados.idSeccion','=','secciones.id')
            
            ->where('grados.estado','=','1')
            ->where('grados.idNivel','=',$filtro)
            ->select('grados.id as idGrado', 'secciones.id as idSeccion', 'grados.nombre as nombreGrado',
            'secciones.nombre as nombreSeccion', 'grados.estado')
            ->orderBy('grados.id' , 'asc')->get();
        }
        else{
            $grado=Grado::join('secciones','grados.idSeccion','=','secciones.id')
            ->join('carreras','grados.idCarrera', '=', 'carreras.id')
            ->where('grados.estado','=','1')
            ->where('grados.idNivel','=',$filtro)
            ->select('grados.id as idGrado', 'carreras.id as idCarrera', 'secciones.id as idSeccion', 'grados.nombre as nombreGrado',
            'carreras.nombre as nombreCarrera', 'secciones.nombre as nombreSeccion', 'grados.estado')
            ->orderBy('grados.id' , 'asc')->get();
        }
        return ['grado' => $grado];
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
        
        $insert = new Grado();
        $insert -> nombre = $request->nombre;
        $insert -> idNivel = $request->idNivel;
        $insert -> idSeccion = $request->idSeccion;
        $insert -> idCarrera = $request->idCarrera;
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
        $update =  Grado::findOrFail($request->idGrado);
        $update-> nombre = $request->nombre;
        $update -> idNivel = $request->idNivel;
        $update -> idSeccion = $request->idSeccion;
        $update -> idCarrera = $request->idCarrera;
        $update -> estado= '1';
        $update -> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $down =  Grado::findOrFail($request->id);
        $down -> estado = '0';
        $down -> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $up =  Grado::findOrFail($request->id);
        $up -> estado = '1';
        $up -> save();
    }
}
