<?php

Route::get('/painel/cliente/getclientes/{id}', 'Painel\ClienteController@GetClientes');

Route::resource('/painel/projeto', 'Painel\ProjetoController');
Route::resource('/painel/cliente', 'Painel\ClienteController');
Route::resource('/painel/tipoprojeto', 'Painel\TipoProjetoController');
Route::resource('/painel/tipoconstrucao', 'Painel\TipoConstrucaoController');
Route::resource('/painel', 'painel\painelController');

Route::get('/painel/projeto/fase/{idFase}', 'Painel\ProjetoController@SaveFase' );
Route::get('/painel/projeto/{idProjeto}/fase/{idFase}', 'Painel\ProjetoController@Fase' );


Route::post('/loginpost', 'LoginController@login')->name('login.login');
Route::get('/login', 'LoginController@index')->name('login.index');

Route::get('/crieja', 'LoginController@crieja');
Route::post('/criacontasave','LoginController@criacontasave');

Route::get('/','LoginController@login');

