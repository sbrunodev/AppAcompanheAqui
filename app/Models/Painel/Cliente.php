<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table ='cliente';
    protected $fillable = ['nome','apelido','cpf','datanascimento','sexo','status','email','senha','foto']; // Todas as coluna que podem ser 
}
