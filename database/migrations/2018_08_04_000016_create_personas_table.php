<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idGenero')->unsigned();
            $table->integer('idTipoPersona')->unsigned();
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('tel', 15)->nullable();
            $table->string('tel2', 15)->nullable();
            $table->string('direccion', 80)->nullable();
            $table->string('identificacion', 30)->nullable();
            $table->string('correo', 80)->nullable()->unique();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idGenero')->references('id')->on('generos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idTipoPersona')->references('id')->on('tipo_personas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');

    }
}
