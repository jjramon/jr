<?php

use Illuminate\Database\Seeder;
use ColegioShaddai\Persona;
use ColegioShaddai\Genero;
use ColegioShaddai\Tipo_persona;
use ColegioShaddai\Rol;
use ColegioShaddai\User;


class PersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $genero = new Genero();
        $genero -> genero = 'Masculino';
        $genero -> estado = '1';
        $genero -> save();

        $tipo_persona = new Tipo_persona();
        $tipo_persona -> nombre = 'Administrador';
        $tipo_persona -> estado= '1';
        $tipo_persona -> save();

        $rol =  new Rol();
        $rol -> nombre = 'Admin';
        $rol -> descripcion = 'Administra el sistema';
        $rol -> estado= '1';
        $rol -> save();

        $persona = new Persona();
        $persona -> idGenero = $genero->id;
        $persona -> idTipoPersona = $tipo_persona->id;
        $persona -> nombre = 'Juan';
        $persona -> apellido = 'González';
        $persona -> identificacion = '1851 29358 0608';
        $persona -> direccion = 'Barrio San Sebastian, Chiquimulilla, Santa Rosa';
        $persona -> tel = '4756-0474';
        $persona -> correo = 'juanra.g.r23@gmail.com';
        $persona -> save();

        $usuario = new User();
        $usuario -> idPersona = $persona->id;
        $usuario -> idRol = $rol->id;
        $usuario -> usuario = 'juanra2018';
        $usuario -> password = bcrypt('JJRAMON');
        $usuario -> pdef = encrypt('JJRAMON');
        $usuario -> save();
    }
}
