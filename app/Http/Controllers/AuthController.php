<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
	{
	    $credentials = $request->only('email', 'password');
	    if ( ! $token = JWTAuth::attempt($credentials)) {
	            return response([
	                'status' => 'error',
	                'error' => 'invalid.credentials',
	                'msg' => 'Invalid Credentials.'
	            ], 400);
	    }
	    return response([
	            'status' => 'success'
	        ])
	        ->header('Authorization', $token);
	}

	public function changePassword(Request $request)
	{
		$user = User::find(Auth::user()->id);
		if(Hash::check($request->input('old_password'), $user->password)) {
			$user->password = bcrypt($request->input('new_password'));
			$user->save();
			return response([
				'status' => 'success',
			]);
		} else {
			return response([
				'status' => 'error',
				'error' => 'password.match.error',
				'msg' => 'Senha antiga inválida.'
			], 400);
		}
	}

	public function user(Request $request)
	{
	    $user = User::find(Auth::user()->id);
	    return response([
            'status' => 'success',
            'data' => $user
        ]);
	}
	public function refresh()
	{
	    return response([
            'status' => 'success'
        ]);
	}
}
