<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class ClienteProjeto extends Model
{
    protected $table = 'clienteprojeto';
    protected $fillable = ['idprojeto','idcliente','situacao'];
    public $timestamps = false;
 
}
