<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('endereco', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iduc');
            $table->string('cep',12)->nullable();
            $table->string('estado',50)->nullable();
            $table->string('cidade',50)->nullable();
            $table->string('bairro',100)->nullable();
            $table->string('numero',50)->nullable();
            $table->string('endereco',200)->nullable();
            $table->string('tipo',10);
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
        Schema::drop('endereco');
    }
}
