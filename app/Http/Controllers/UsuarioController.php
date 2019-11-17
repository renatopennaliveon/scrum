<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use View;
use App\Usuario;

class UsuarioController extends Controller
{
	public function authenticate(Request $request){
    	if(Auth::attempt(['login' => $request->login, 'password' => $request->password])){
    		$this->dashboard();
      	}
   	}
	public function dashboard(){
		$id = Auth::user()->id;
		$dados_usuario = Usuario::carregarDadosUsuario($id);
		return View::make('dashboard',compact('dados_usuario'));
	}
	public function listagemUsuarios(){
		$usuarios = json_decode(Usuario::listagemUsuarios());
		foreach($usuarios as $usuario){
			if($usuario->papel_scrum == "sm"){
				$usuario->papel_scrum = "Scrum Master";
			}
			elseif($usuario->papel_scrum == "po"){
				$usuario->papel_scrum = "Product Owner";
			}
			else{
				$usuario->papel_scrum = "Equipe";
			}
		}
		return View::make('listagem_usuarios',compact('usuarios'));
	}
	public function cadastro(){
		return View::make('cadastro_usuarios');
	}
	public function cadastrar(Request $request){
		$json_cadastrar = Usuario::cadastrar($request);
		return $json_cadastrar;
	}
	public function edicao($id){
		$usuario = json_decode(Usuario::edicao($id));
		return View::make('edicao_usuario',compact('usuario'));
	}
	public function editar(Request $request){
		$json_editar = Usuario::editar($request);
		return $json_editar;
	}
	public function remover(Request $request){
		$json_remover = Usuario::remover($request);
		return $json_remover;
	}
}