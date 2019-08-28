<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class TipoProjeto extends Model
{
	// Nome da tabela no banco de dados.
    protected $table ='tipoprojeto';

    // Campos que são de entradas pelos usuários.
    protected $fillable = ['descricao','observacao','status','usuarioID','empresaID']; 
}
