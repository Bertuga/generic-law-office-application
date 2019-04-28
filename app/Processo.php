<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = ['id_cliente', 'numero'];

    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'alterado_em';
}
