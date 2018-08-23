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



Route::get('roles', function () {
    return view('roles');
});
Route::get('alumnos', function () {
    return view('alumnos');
});
Route::get('tipo de persona', function () {
    return view('tipoPersonas');
});
Route::get('registrarAlumnos', function () {
    return view('alumnos/registrarAlumnos');
});
Route::get('/prueba', function () {
    return view('alumnos/prueba');
});