<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'contato';
    protected $fillable = ['iduc','email','telefone','celular','tipo']; 
}
