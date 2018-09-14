<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarVistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_vistas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idRoll')->unsigned();
            $table->integer('idVista')->unsigned();
            $table->timestamps();
            $table->foreign('idRoll')->references('id')->on('rols')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idVista')->references('id')->on('vistas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_vistas');
    }
}
