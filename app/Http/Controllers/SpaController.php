<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
