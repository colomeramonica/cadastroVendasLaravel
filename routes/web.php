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
Route::get('/home', function () {
    return view('home');
});
Route::get('vendas', 'VendaController@index'); // Lista todas as vendas
Route::post('venda/new', 'VendaController@create'); // Cria uma nova venda
Route::post('venda/sellers', 'VendaController@getSellers'); // Lista os vendedores
########################
Route::get('vendedores', 'VendedorController@index'); // Lista todos os vendedores
Route::post('vendedor/new', 'VendedorController@addNew'); // Adiciona um novo vendedor
Route::post('vendedor/get', 'VendedorController@getById'); // Recupera informações do vendedor
Route::post('vendedor/update', 'VendedorController@update'); // Atualiza os dados do vendedor
Route::post('vendedor/delete', 'VendedorController@remove'); // Deleta um vendedor