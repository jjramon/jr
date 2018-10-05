<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idNivel')->unsigned();
            $table->integer('idSeccion')->unsigned();
            $table->integer('idCarrera')->unsigned()->nullable();
            $table->string('nombre',20);
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idNivel')->references('id')->on('niveles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idSeccion')->references('id')->on('secciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCarrera')->references('id')->on('carreras')->onUpdate('cascade')->onDelete('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grados');
    }
}
