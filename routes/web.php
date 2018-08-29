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
