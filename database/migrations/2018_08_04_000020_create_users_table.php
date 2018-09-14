<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idRol')->unsigned();
            $table->integer('idPersona')->unsigned();
            $table->string('usuario',30)->unique();
            $table->string('password',255);
            $table->foreign('idRol')->references('id')->on('rols')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idPersona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('estado')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
