<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Usuario;

class UsuarioController extends Controller
{
	public function cadastro(){
		return View::make('cadastro_usuarios');
	}

	public function cadastrar(Request $request){
		$json_cadastrar = Usuario::cadastrar($request);
		return $json_cadastrar;
	}
}
