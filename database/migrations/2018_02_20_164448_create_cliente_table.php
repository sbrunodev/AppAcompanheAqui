<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //protected $fillable = ['nome','apelido','cpf','datanascimento','sexo','status','email','foto']; // Todas as coluna que podem ser 
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->string('apelido',100)->nullable();
            $table->string('cpf')->nullable();;
            $table->date('datanascimento')->nullable();
            $table->integer('sexo')->nullable();;
            $table->boolean('status')->nullable();;
            $table->string('email',100)->nullable();
            $table->string('senha',50)->nullable();
            $table->string('foto',80)->nullable();
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
         Schema::drop('cliente');
    }
}