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
            $table->integer('idUsuario');
            $table->date('fecha');
            $table->string('mesPagado',20);
            $table->boolean('estado');
            $table->timestamps();
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
        Schema::dropIfExists('colegiaturas');
    }
}
