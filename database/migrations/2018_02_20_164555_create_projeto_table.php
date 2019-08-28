<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::create('projeto', function (Blueprint $table) {

            $table->increments('id');
            $table->string('descricao',200);
            $table->integer('tipoprojeto')->nullable();
            $table->date('datainicio')->nullable();
            $table->date('dataprevisao')->nullable();
            $table->date('datafinalizacao')->nullable();
            $table->integer('situacao')->nullable();
            $table->integer('observacao')->nullable();
            $table->string('longitude',50)->nullable();
            $table->string('latitude',50)->nullable();
         
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
        Schema::drop('projeto');
    }
}
