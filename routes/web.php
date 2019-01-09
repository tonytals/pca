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



Route::group(['middleware' => ['auth']], function() {

  Route::get('/dashboardTutor', ['as'=>'dashboardTutor','uses'=>'DashboardController@dashboardTutor']);
  Route::get('/dashboardAluno', ['as'=>'dashboardAluno','uses'=>'DashboardController@dashboardAluno']);
  Route::get('/', ['as'=>'dashboard','uses'=>'DashboardController@index']);

  Route::get('pacientes/adicionar', ['as'=>'pacientes.adicionar','uses'=>'PacienteController@adicionar']);
  Route::resource('pacientes', 'PacienteController');

  Route::post('comments', 'ComentarioController@store');
  Route::put('comments/{comment}', 'ComentarioController@update');
  Route::post('comments/{comment}', 'ComentarioController@reply');

  Route::resource('prontuarios', 'ProntuarioController');

  Route::get('familias/adicionar', ['as'=>'familias.adicionar','uses'=>'FamiliaController@adicionar']);
  Route::resource('familias', 'FamiliaController');

  Route::get('summernoteeditor',array('as'=>'summernoteeditor.get','uses'=>'SummernotefileController@getSummernoteeditor'));
  Route::post('summernoteeditor',array('as'=>'summernoteeditor.post','uses'=>'SummernotefileController@postSummernoteeditor'));

  Route::put('notificacoes-read', ['as'=>'notificacoes.read','uses'=>'NotificationController@markAsRead']);
  Route::get('notificacoes', ['as'=>'notificacoes','uses'=>'NotificationController@notificacoes']);

  Route::delete('agendamentos/delete/{id}', 'AgendamentoController@destroy');
  Route::resource('agendamentos', 'AgendamentoController');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {

  Route::get('/', ['as'=>'admin','uses'=>'Admin\AdminController@index']);

  Route::get('usuarios/importar', ['as'=>'usuarios.importar','uses'=>'Admin\UsuarioController@importar']);
  Route::post('usuarios/importarCsv', ['as'=>'usuarios.importarCsv','uses'=>'Admin\UsuarioController@importarCsv']);
  Route::get('usuarios/perfil/{id}', ['as'=>'usuarios.perfil','uses'=>'Admin\UsuarioController@perfil']);
  Route::get('usuarios/adicionar', ['as'=>'usuarios.adicionar','uses'=>'Admin\UsuarioController@adicionar']);
  Route::resource('usuarios', 'Admin\UsuarioController');

  Route::get('usuarios/papel/{id}', ['as'=>'usuarios.papel','uses'=>'Admin\UsuarioController@papel']);
  Route::post('usuarios/papel/{papel}', ['as'=>'usuarios.papel.store','uses'=>'Admin\UsuarioController@papelStore']);
  Route::delete('usuarios/papel/{usuario}/{papel}', ['as'=>'usuarios.papel.destroy','uses'=>'Admin\UsuarioController@papelDestroy']);

  Route::resource('papeis', 'Admin\PapelController');

  Route::get('papeis/permissao/{id}', ['as'=>'papeis.permissao','uses'=>'Admin\PapelController@permissao']);
  Route::post('papeis/permissao/{permissao}', ['as'=>'papeis.permissao.store','uses'=>'Admin\PapelController@permissaoStore']);
  Route::delete('papeis/permissao/{papel}/{permissao}', ['as'=>'papeis.permissao.destroy','uses'=>'Admin\PapelController@permissaoDestroy']);

  Route::get('aluno/{id}', ['as'=>'tutor.aluno','uses'=>'Admin\TutorController@aluno_show']);
});
