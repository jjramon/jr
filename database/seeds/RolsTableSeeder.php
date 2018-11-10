<?php

use Illuminate\Database\Seeder;
use ColegioShaddai\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rol =  new Rol();
        $rol -> nombre = 'Padre';
        $rol -> descripcion = 'Visualiza las calificaciones';
        $rol -> estado= '1';
        $rol -> save();

        $rol =  new Rol();
        $rol -> nombre = 'Docente';
        $rol -> descripcion = 'Registra las calificaiones';
        $rol -> estado= '1';
        $rol -> save();

        $rol =  new Rol();
        $rol -> nombre = 'Secretaria';
        $rol -> descripcion = 'Registra los pagos, el personal y las inscripciones';
        $rol -> estado= '1';
        $rol -> save();

        $rol =  new Rol();
        $rol -> nombre = 'Direccion';
        $rol -> descripcion = 'Administracion del establecimiento';
        $rol -> estado= '1';
        $rol -> save();
    }
}
