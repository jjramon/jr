<?php

use Illuminate\Database\Seeder;
use colegioShaddai\Tipo_persona;

class Tipo_personasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Alumno';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Padre de familia';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Docente';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Director';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Secretaria';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Sub-director';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();
    }
}
