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
            $table->integer('idRoll');
            $table->integer('idPersona');
            $table->string('password',25);
            $table->foreign('idRoll')->references('id')->on('roles')->onUpdate('cascade');
            $table->foreign('idPersona')->references('id')->on('personas')->onUpdate('cascade');
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
