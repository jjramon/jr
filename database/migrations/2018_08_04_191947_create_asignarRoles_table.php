<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignarRoles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idRoll');
            $table->integer('idUsuario');
            $table->timestamps();
            $table->foreign('idRoll')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_roles');
    }
}
