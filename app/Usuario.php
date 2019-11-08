<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	public static function cadastrar($dados){
		$usuario = new Usuario();
		$usuario->nome = $dados->nome;
		$usuario->email = $dados->email;
		$usuario->celular = $dados->celular;
		$usuario->login = $dados->login;
		$usuario->senha = $dados->senha;
		$usuario->papel_scrum = $dados->papel_scrum;
		$usuario->save();
		return json_encode($usuario);
	}
}
