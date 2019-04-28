<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Cliente;
use App\Telefone;

class SpaController extends Controller
{
    public function index()
    {
    	return view('main');
    }

    public function listClients()
    {
    	return response()->json(Cliente::all());
    }

    public function listPhones(Request $request)
    {
    	return response()->json(Telefone::where(['id_cliente' => $request->route('id_client')])->get());
    }

    public function fetchPhone(Request $request)
    {
    	try {
    		return response()->json(Telefone::where(['id' => $request->route('id'), 'id_cliente' => $request->route('id_client')])->firstOrFail());
    	}
    	catch(\Exception $e) {
    		return response([
				'status' => 'error',
				'error' => 'Telefone inexistente',
			], 400);
    	}
    }

    public function fetchClient(Request $request)
    {
    	try {
    		return response()->json(Cliente::findOrFail($request->route('id')));
    	}
    	catch(\Exception $e) {
    		return response([
				'status' => 'error',
				'error' => 'Cliente inexistente',
			], 400);
    	}
    }

    public function deleteClient(Request $request)
    {
    	try {
    		$cliente = Cliente::findOrFail($request->input('id'));
    		$cliente->delete();
    		return response([
				'status' => 'success',
				'message' => 'Cliente excluído com sucesso',
			], 200);
    	}
    	catch(\Exception $e) {
    		return response([
				'status' => 'error',
				'error' => 'Cliente inexistente',
			], 400);
    	}
    }

    public function deletePhone(Request $request)
    {
    	try {
    		$telefone = Telefone::findOrFail($request->input('id'));
    		$telefone->delete();
    		return response([
				'status' => 'success',
				'message' => 'Telefone excluído com sucesso',
			], 200);
    	}
    	catch(\Exception $e) {
    		return response([
				'status' => 'error',
				'error' => 'Telefone inexistente',
			], 400);
    	}
    }

    public function registerClient(Request $request)
    {
		$validation = Validator::make($request->all(),[
			'id' => 'nullable|integer',
			'nome' => 'required|string',
			'rg' => 'required|string|',
			'nascimento' => 'required|string',
			'cpf' => [
				'required',
				'string',
				'size:14',
				function($attribute, $value, $fail) {
					$cpf = preg_replace("/[^0-9]/", "", $value);
					$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
					if (strlen($cpf) != 11) {
						$fail('CPF inválido');
					}
					else if ($cpf == '00000000000' || 
						$cpf == '11111111111' || 
						$cpf == '22222222222' || 
						$cpf == '33333333333' || 
						$cpf == '44444444444' || 
						$cpf == '55555555555' || 
						$cpf == '66666666666' || 
						$cpf == '77777777777' || 
						$cpf == '88888888888' || 
						$cpf == '99999999999') {
						$fail('CPF inválido');
					 } else {   
						for ($t = 9; $t < 11; $t++) {
							for ($d = 0, $c = 0; $c < $t; $c++) {
								$d += $cpf{$c} * (($t + 1) - $c);
							}
							$d = ((10 * $d) % 11) % 10;
							if ($cpf{$c} != $d) {
								$fail('CPF inválido');
							}
						}
					}
				},
				 Rule::unique('clientes')->ignore($request->input('id')),
			],
			'endereco' => 'required|string',
			'numero' => 'required|string',
			'bairro' => 'required|string',
			'cidade' => 'required|string',
			'estado' => 'required|string|size:2',
			'cep' => 'required|string|size:9',
			'email' => 'nullable|email|string',
			'pis' => 'nullable|string',
			'ct' => 'nullable|string'
		]);
		if(!$validation->fails()) {
    		$cliente = Cliente::updateOrCreate(['id' => $request->input('id')], $request->all());
			return response([
				'status' => 'success',
			]);
		} else {
			return response([
				'status' => 'error',
				'errors' => collect($validation->errors()),
			], 400);
		}
    }

    public function registerPhone(Request $request)
    {
		$validation = Validator::make($request->all(),[
			'id' => 'nullable|integer',
			'id_cliente' => 'integer',
			'nome' => 'required|string',
			'numero' => 'required|string|',
		]);
		if(!$validation->fails()) {
    		$telefone = Telefone::updateOrCreate(['id' => $request->input('id')], $request->all());
			return response([
				'status' => 'success',
			]);
		} else {
			return response([
				'status' => 'error',
				'errors' => collect($validation->errors()),
			], 400);
		}
    }
}
