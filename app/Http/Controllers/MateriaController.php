<?php

namespace colegioShaddai\Http\Controllers;

use Illuminate\Http\Request;
use colegioShaddai\Materia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function buscarMateria(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $filtro= $request->filtro;
        
        $date = Carbon::now();
        $anio = $date->format('Y');
        $mes = $date->format('m');
        if ($mes > 10)
        {
            $date = new Carbon('next year');
            $anio = $date->format('Y');
        }

        
        if($filtro != 4){
            $materia = Materia::join('asignar_materia','materias.id','=','asignar_materia.idMateria')
            ->join('grados', 'asignar_materia.idGrado','=','grados.id')
            ->join('secciones', 'secciones.id','=','grados.idSeccion')
            ->join('niveles', 'niveles.id','=','grados.idNivel')
            ->where('materias.estado','=',"1")
            ->where('niveles.id', '=', $filtro)
            ->select('materias.id', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", 
            secciones.nombre) as nombre'))
            ->orderBy('nombre' , 'asc')->get();
        }
        if($filtro == 4){
            $materia = Materia::join('asignar_materia','materias.id','=','asignar_materia.idMateria')
            ->join('grados', 'asignar_materia.idGrado','=','grados.id')
            ->join('niveles', 'niveles.id','=','grados.idNivel')
            ->join('secciones', 'secciones.id','=','grados.idSeccion')
            ->join('carreras', 'carreras.id','=','grados.idCarrera')
            ->where('materias.estado','=',"1")
            ->where('niveles.id', '=', $filtro)
            ->select('materias.id', DB::raw('CONCAT(materias.nombre, " / ", grados.nombre, " / ", 
            secciones.nombre, " / ", carreras.nombre) as nombre'))
            ->orderBy('nombre' , 'asc')->get();
        }
        

        return ['materia' => $materia];
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
