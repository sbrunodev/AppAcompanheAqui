<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoprojetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tipoprojeto', function (Blueprint $table) {
            // ---
            // Informações da Tabela.
            $table->increments('id');
            $table->string('descricao',50)->nullable();
            $table->string('observacao',200)->nullable();
            //Situação para saber se esse elemento está Ativo ou Desativo;
            $table->boolean('status')->nullable();

            // ---
            // Saber quem foi o usuário que criou e a qual empresa ele pertence.
            // O usuário e empresa não pode ser nullable, só estou deixando assim para teste
            $table->integer('usuarioID');
            $table->integer('empresaID');
            
            // ---
            // Quando ele criou e atualizou.
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
        Schema::dropIfExists('tipoprojeto');
    }
}
