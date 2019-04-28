<?php

namespace App;

use App\Telefone;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'rg', 'nascimento', 'cpf', 'endereco', 
    	'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'email'];

    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'alterado_em';

}
