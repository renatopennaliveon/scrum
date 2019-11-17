<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class Tarefa extends Model
{
	public function Usuario(){
		return $this->belongsTo('App\Usuario','id_usuario','id');
	}
	public static function pegarUltimoId(){
		$tarefas = Tarefa::orderBy('id','desc')->take(1)->get();
		return json_encode($tarefas);
	}
	public static function listarTarefas(){
		$tarefas = Tarefa::get();
		return $tarefas;
	}
	public static function cadastrarTarefa($dados){
		$tarefa = new Tarefa();
		$tarefa->titulo = $dados->titulo;
		$tarefa->descricao = $dados->descricao;
		$tarefa->save();
		return json_encode($tarefa);
	}
	public static function edicaoTarefa($id_tarefa){
		return json_encode(Tarefa::find($id_tarefa));
	}
	public static function editarTarefa($dados){
		$tarefa = Tarefa::find($dados->id);
		$tarefa->titulo = $dados->titulo;
		$tarefa->descricao = $dados->descricao;
		$tarefa->save();
		return json_encode($tarefa);
	}
	public static function atribuirTarefa($dados){
		$tarefa = Tarefa::find($dados->id_tarefa);
		$tarefa->id_usuario = $dados->id_usuario;
		$tarefa->save();
		return json_encode($tarefa);
	}
	public static function desatribuirTarefa($dados){
		$tarefa = Tarefa::find($dados->id_tarefa);
		$tarefa->id_usuario = 0;
		$tarefa->save();
		return json_encode($tarefa);
	}
	public static function removerTarefa($dados){
		$tarefa = Tarefa::find($dados->id);
		$tarefa->delete();
		return json_encode($tarefa);
	}
}