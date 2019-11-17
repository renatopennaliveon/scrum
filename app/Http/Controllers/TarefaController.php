<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Tarefa;
use App\Usuario;

class TarefaController extends Controller
{
	public function pegarUltimoId(){
		return $json = Tarefa::pegarUltimoId();
	}
	public function cadastrarTarefa(Request $request){
		$json_cadastrar = Tarefa::cadastrarTarefa($request);
		return $json_cadastrar;
	}
	public function edicaoTarefa($id){
		$tarefa = Tarefa::edicaoTarefa($id);
		return $tarefa;
	}
	public function editarTarefa(Request $request){
		$tarefa = Tarefa::editarTarefa($request);
		return $tarefa;
	}
	public function atribuicaoTarefa($id){
		$usuario = Usuario::find($id);
		$tarefas = Tarefa::listarTarefas();
		return View::make('atribuicao_tarefa',compact('usuario','tarefas'));
	}
	public function atribuirTarefa(Request $request){
		return $tarefa = Tarefa::atribuirTarefa($request);
	}
	public function desatribuirTarefa(Request $request){
		return $tarefa = Tarefa::desatribuirTarefa($request);
	}
	public function removerTarefa(Request $request){
		return $tarefa = Tarefa::removerTarefa($request);
	}
}