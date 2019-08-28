<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table ='endereco';
    protected $fillable = ['iduc','cep','estado','cidade','bairro','numero','endereco','tipo']; 
}
