<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('idprojeto');
            $table->string('descricaofase',100);
            $table->string('descricao',200);
            $table->date('datainicio')->nullable();
            $table->date('dataprevisao')->nullable();
            $table->date('datatermino')->nullable();
            $table->integer('situacao')->nullable();
            $table->string('observacao',400)->nullable();
            
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
        Schema::drop('fase');
    }
}
