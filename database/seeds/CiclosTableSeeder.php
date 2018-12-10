<?php

use Illuminate\Database\Seeder;
use colegioShaddai\Ciclo;
use colegioShaddai\Mes;

class CiclosTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mes = new Mes();
        $mes -> nombre = 'Enero';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Febrero';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Marzo';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Abril';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Mayo';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Junio';
        $mes -> estado = '1';
        $mes -> save();
        
        $mes = new Mes();
        $mes -> nombre = 'Julio';
        $mes -> estado = '1';
        $mes -> save();
        
        $mes = new Mes();
        $mes -> nombre = 'Agosto';
        $mes -> estado = '1';
        $mes -> save();
        
        $mes = new Mes();
        $mes -> nombre = 'Septiembre';
        $mes -> estado = '1';
        $mes -> save();
        
        $mes = new Mes();
        $mes -> nombre = 'Octubre';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Nomviembre';
        $mes -> estado = '1';
        $mes -> save();

        $mes = new Mes();
        $mes -> nombre = 'Diciembre';
        $mes -> estado = '1';
        $mes -> save();

        for ($i = 0; $i < 10; $i++){
            $cicle = 2017 + $i;
            $ciclo = new Ciclo();
            $ciclo -> nombre = $cicle;
            $ciclo -> estado= '1';
            $ciclo -> save();
        }
    }
}
