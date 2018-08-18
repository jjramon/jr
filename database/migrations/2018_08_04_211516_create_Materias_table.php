<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',20);
            $table->integer('idAlumno');
            $table->integer('idGrado');
            $table->timestamps();
            $table->foreign('idAlumno')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('idGrado')->references('id')->on('grados')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catedras');
    }
}
