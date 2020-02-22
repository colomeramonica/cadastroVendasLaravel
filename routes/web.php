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

Route::get('vendas', 'VendaController@index'); // Lista todas as vendas
Route::post('venda/new', 'VendaController@create'); // Cria uma nova venda
Route::get('vendedores', 'VendedorController@getAll'); // Lista todos os vendedores
Route::post('vendedor/new', 'VendedorController@addNew'); // Adiciona um novo vendedor
Route::get('vendedor/{id}/vendas', 'VendedorController@show'); // Lista as vendas daquele vendedor
Route::put('vendedor/{id}', 'VendedorController@update'); // Atualiza os dados do vendedor
Route::delete('vendedor/delete/{id}', 'VendedorController@destroy'); // Inativa um vendedor