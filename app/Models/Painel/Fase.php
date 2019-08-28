<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    //
    protected $table = 'fase';
    protected $fillable = ['idprojeto','descricaofase','descricao','dataincio','dataprevisao','datatermino','situacao','observacao'];

}
