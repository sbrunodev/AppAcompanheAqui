<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('contato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iduc');
            $table->string('email',100)->nullable();
            $table->string('telefone',20)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('tipo',10)->nullable();
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
        Schema::drop('contato');
    }
}

