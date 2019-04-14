<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cliente;

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

    public function registerClients(Request $request)
    {
		$validation = Validator::make($request->all(),[
			'id' => 'nullable|integer',
			'nome' => 'required|string',
			'rg' => 'required|string|',
			'nascimento' => 'required|string',
			'cpf' => 'required|string|size:14',
			'endereco' => 'required|string',
			'numero' => 'required|string',
			'bairro' => 'required|string',
			'cidade' => 'required|string',
			'estado' => 'required|string|size:2',
			'cep' => 'required|string|size:8',
			'email' => 'nullable|email|string'
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
}
