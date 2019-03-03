<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = ['id_cliente', 'nome', 'numero'];

    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'alterado_em';
}
