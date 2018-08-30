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
    return view('plantilla/contenido');
});
Route::get('/genero','GeneroController@index');
Route::post('/genero/registrar', 'GeneroController@store');
Route::put('/genero/actualizar', 'GeneroController@update');
Route::put('/genero/desactivar', 'GeneroController@desactivar');
Route::put('/genero/activar', 'GeneroController@activar');
Route::get('/rol','RolController@index');
Route::post('/rol/registrar', 'RolController@store');
Route::put('/rol/actualizar', 'RolController@update');
Route::put('/rol/desactivar', 'RolController@desactivar');
Route::put('/rol/activar', 'RolController@activar');
Route::get('/ciclo','CicloController@index');
Route::post('/ciclo/registrar', 'CicloController@store');
Route::put('/ciclo/actualizar', 'CicloController@update');
Route::put('/ciclo/desactivar', 'CicloController@desactivar');
Route::put('/ciclo/activar', 'CicloController@activar');
Route::get('/dia','DiaController@index');
Route::post('/dia/registrar', 'DiaController@store');
Route::put('/dia/actualizar', 'DiaController@update');
Route::put('/dia/desactivar', 'DiaController@desactivar');
Route::put('/dia/activar', 'DiaController@activar');
Route::get('/seccion','SeccioneController@index');
Route::post('/seccion/registrar', 'SeccioneController@store');
Route::put('/seccion/actualizar', 'SeccioneController@update');
Route::put('/seccion/desactivar', 'SeccioneController@desactivar');
Route::put('/seccion/activar', 'SeccioneController@activar');
Route::get('/bimestre','BimestreController@index');
Route::post('/bimestre/registrar', 'BimestreController@store');
Route::put('/bimestre/actualizar', 'BimestreController@update');
Route::put('/bimestre/desactivar', 'BimestreController@desactivar');
Route::put('/bimestre/activar', 'BimestreController@activar');
