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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('gimnastas/import', 'GimnastasController@import')->name('gimnastas.import'); // se agrega esta ruta antes de las rutas generadas por el controlador. Ver en los links (2do link)
Route::resource('gimnastas', 'GimnastasController');

Route::post('/import-excel', 'ExcelController@importUsers');

Route::resource('aparato', 'AparatoController');

Route::post('rotacion/index','RotacionController@store')->name('rotacion');
Route::get('rotacion/index','RotacionController@index')->name('rotacion');
Route::resource('rotacion', 'RotacionController'); // ver si es 'rotaciones' o 'rotacion'

Route::post('salto/index/{id}', ['as' => 'salto.index', 'uses' => 'SaltoController@select']);
//Route::post('salto/index', 'SaltoController@select')->name('salto');
Route::get('salto/index','SaltoController@index')->name('salto'); // antes tenía salto/index. con esta ruta funciona... 03/09 tenía /index solamente y no iba funcionando el que iba agregando
Route::resource('salto','SaltoController');

Route::post('suelo/index/{id}', ['as' => 'suelo.index', 'uses' => 'SueloController@select']);
Route::get('suelo/index','SueloController@index')->name('suelo');
Route::resource('suelo', 'SueloController');

Route::post('viga/index/{id}', ['as' => 'viga.index', 'uses' => 'VigaController@select']);
Route::get('viga/index','VigaController@index')->name('viga');
Route::resource('viga', 'VigaController');

Route::post('barras/index/{id}', ['as' => 'barras.index', 'uses' => 'BarrasController@select']);
Route::get('barras/index','BarrasController@index')->name('barras');
Route::resource('barras', 'BarrasController');

Route::resource('resultado', 'ResultadoController');

Route::get('puntaje/index','PuntajeController@index')->name('puntaje');
Route::post('puntaje/index','PuntajeController@index')->name('puntaje');
Route::post('puntaje/index','PuntajeController@store')->name('puntaje');
Route::post('puntaje/index/{id}', ['as' => 'puntaje.index', 'uses' => 'PuntajeController@select']);
Route::resource('puntaje','PuntajeController');

Route::post('configuracion/index','ConfiguracionController@store')->name('configuracion');
Route::get('configuracion/index','ConfiguracionController@update')->name('configuracion.update');
Route::resource('configuracion', 'ConfiguracionController');

Route::post('nivel/index','NivelController@store')->name('nivel');
Route::get('nivel/index','NivelController@index')->name('nivel');
Route::resource('nivel', 'NivelController');




