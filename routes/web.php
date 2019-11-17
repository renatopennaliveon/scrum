<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*========================================================== ROTAS Usuario GET ==========================================================*/
Route::get('/dashboard','UsuarioController@dashboard')->name('dashboard');
Route::get('/listagemUsuarios','UsuarioController@listagemUsuarios')->name('listagemUsuarios');
Route::get('/cadastroUsuario','UsuarioController@cadastro')->name('cadastroUsuario');
Route::get('/edicaoUsuario/{id}','UsuarioController@edicao')->name('edicaoUsuario');
Route::get('/removerUsuario','UsuarioController@detalhes')->name('detalhesUsuario');

/*========================================================== ROTAS Usuario POST ==========================================================*/
Route::post('/cadastrarUsuario','UsuarioController@cadastrar')->name('cadastrarUsuario');
Route::post('/editarUsuario','UsuarioController@editar')->name('editarUsuario');
Route::post('/removerUsuario','UsuarioController@remover')->name('removerUsuario');

/*========================================================== ROTAS Tarefa GET ============================================================*/
Route::get('/atribuicaoTarefa/{id}','TarefaController@atribuicaoTarefa')->name('atribuicaoTarefa');
Route::get('/edicaoTarefa/{id}','TarefaController@edicaoTarefa')->name('edicaoTarefa');
Route::get('/pegarUltimoId','TarefaController@pegarUltimoId')->name('pegarUltimoId');

/*========================================================== ROTAS Tarefa POST ===========================================================*/
Route::post('/cadastrarTarefa','TarefaController@cadastrarTarefa')->name('cadastrarTarefa');
Route::post('/editarTarefa','TarefaController@editarTarefa')->name('editarTarefa');
Route::post('/atribuirTarefa','TarefaController@atribuirTarefa')->name('atribuirTarefa');
Route::post('/desatribuirTarefa','TarefaController@desatribuirTarefa')->name('desatribuirTarefa');
Route::post('/removerTarefa','TarefaController@removerTarefa')->name('removerTarefa');
