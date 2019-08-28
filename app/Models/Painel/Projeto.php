<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table ='projeto';
    protected $fillable = ['descricao','tipoprojeto','datainicio','dataprevisao','datafinalizacao','situacao','longitude','latitude']; 
}
