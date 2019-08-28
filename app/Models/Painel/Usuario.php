<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = ['nome','apelido','cpf','datanascimento','sexo','senha','status','email','foto']; // Todas as coluna que podem ser 
        
}
