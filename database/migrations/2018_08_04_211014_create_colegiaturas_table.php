<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegiaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAlumno');
            $table->date('fecha');
            $table->integer('idMes');
            $table->integer('idCiclo');
            $table->boolean('estado')->default(1);
            $table->string('condicion');
            $table->timestamps();
            $table->foreign('idAlumno')->references('id')->on('personas')->onUpdate('cascade');
            $table->foreign('idMes')->references('id')->on('meses')->onUpdate('cascade');
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colegiaturas');
    }
}
