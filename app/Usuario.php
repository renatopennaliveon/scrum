<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	public static function listagemUsuarios(){
		$usuarios = Usuario::get();
		return json_encode($usuarios);
	}
	public static function carregarDadosUsuario($id_usuario){
		$vetor = array();
		$usuario = Usuario::find($id_usuario);
		$vetor['nome'] = $usuario->nome;
		$vetor['email'] = $usuario->email;
		$vetor['celular'] = $usuario->celular;
		$vetor['login'] = $usuario->login;
		$vetor['senha'] = $usuario->senha;
		$vetor['papel_scrum'] = $usuario->papel_scrum;
		return json_encode($vetor);
	}
	public static function edicao($id_usuario){
		$vetor = array();
		$usuario = Usuario::find($id_usuario);
		$vetor['id'] = $usuario->id;
		$vetor['nome'] = $usuario->nome;
		$vetor['email'] = $usuario->email;
		$vetor['celular'] = $usuario->celular;
		$vetor['login'] = $usuario->login;
		$vetor['papel_scrum'] = $usuario->papel_scrum;
		return json_encode($vetor);
	}
	public static function editar($dados){
		$usuario = Usuario::find($dados->id);
		$usuario->nome = $dados->nome;
		$usuario->email = $dados->email;
		$usuario->celular = $dados->celular;
		$usuario->login = $dados->login;
		$usuario->papel_scrum = $dados->papel_scrum;
		$usuario->save();
		return json_encode($usuario);
	}
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
	public static function remover($dados){
		$usuario = Usuario::find($dados['id']);
		$usuario->delete();
		return json_encode($usuario);
	}
}