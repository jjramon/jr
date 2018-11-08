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




Route::get('/main', function () {
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

Route::get('/nivel','NiveleController@index');
Route::post('/nivel/registrar', 'NiveleController@store');
Route::put('/nivel/actualizar', 'NiveleController@update');
Route::put('/nivel/desactivar', 'NiveleController@desactivar');
Route::put('/nivel/activar', 'NiveleController@activar');

Route::get('/horario','HorarioController@index');
Route::post('/horario/registrar', 'HorarioController@store');
Route::put('/horario/actualizar', 'HorarioController@update');
Route::put('/horario/desactivar', 'HorarioController@desactivar');
Route::put('/horario/activar', 'HorarioController@activar');
Route::get('/horario/selectDia', 'HorarioController@selectDia');

Route::get('/materia','MateriaController@index');
Route::post('/materia/registrar', 'MateriaController@store');
Route::put('/materia/actualizar', 'MateriaController@update');
Route::put('/materia/desactivar', 'MateriaController@desactivar');
Route::put('/materia/activar', 'MateriaController@activar');

Route::get('/tipo_persona','Tipo_personaController@index');
Route::post('/tipo_persona/registrar', 'Tipo_personaController@store');
Route::put('/tipo_persona/actualizar', 'Tipo_personaController@update');
Route::put('/tipo_persona/desactivar', 'Tipo_personaController@desactivar');
Route::put('/tipo_persona/activar', 'Tipo_personaController@activar');
Route::get('/tipo_persona/selectDia', 'Tipo_personaController@selectDia');

Route::get('/persona','PersonaController@index');
Route::post('/persona/registrar', 'PersonaController@store');
Route::put('/persona/actualizar', 'PersonaController@update');
Route::put('/persona/desactivar', 'PersonaController@desactivar');
Route::put('/persona/desactivarPersona', 'PersonaController@desactivarPersona');
Route::put('/persona/desactivarUsuario', 'PersonaController@desactivarUsuario');
Route::put('/persona/activar', 'PersonaController@activar');
Route::put('/persona/activarPersona', 'PersonaController@activarPersona');
Route::put('/persona/activarUsuario', 'PersonaController@activarUsuario');
Route::get('/persona/selectRol', 'RolController@selectRol');
Route::get('/persona/selectTipoPersona', 'Tipo_personaController@selectTipoPersona');
Route::get('/persona/selectGenero', 'GeneroController@selectGenero');
Route::get('/persona/personaPdf/{id}','PersonaController@pdfPersonal')->name('personal_pdf');

Route::get('/alumno','AlumnoController@index');
Route::post('/alumno/registrar', 'AlumnoController@store');
Route::put('/alumno/actualizar', 'AlumnoController@update');
Route::put('/alumno/desactivar', 'AlumnoController@desactivar');
Route::put('/alumno/activar', 'AlumnoController@activar');
Route::get('/alumno/selectTipoPersona', 'AlumnoController@selectTipoPersona');
Route::get('/alumno/selectGenero', 'AlumnoController@selectGenero');
Route::get('/alumno/selectGrado', 'GradoController@selectGrado');
Route::get('/alumno/selectCiclo', 'CicloController@selectCiclo');
Route::post('/alumno/reinscripcion', 'AlumnoController@reinscripcion');

Route::get('/user','UserController@index');
Route::post('/user/registrar', 'UserController@store');
Route::put('/user/actualizar', 'UserController@update');
Route::put('/user/desactivar', 'UserController@desactivar');
Route::put('/user/activar', 'UserController@activar');

Route::get('/asignaralumno','AsgPadreAlumController@index');
Route::get('/asignaralumno/buscarpadre','PersonaController@buscarPadre');
Route::get('/asignaralumno/buscarhijo','PersonaController@buscarHijo');
Route::post('/asignaralumno/registrar','AsgPadreAlumController@store');
Route::put('/asignaralumno/actualizar','AsgPadreAlumController@update');
Route::put('/asignaralumno/desacativar','AsgPadreAlumController@desactivar');
Route::put('/asignaralumno/acativar','AsgPadreAlumController@activar');

Route::get('/carrera','CarreraController@index');
Route::post('/carrera/registrar', 'CarreraController@store');
Route::put('/carrera/actualizar', 'CarreraController@update');
Route::put('/carrera/desactivar', 'CarreraController@desactivar');
Route::put('/carrera/activar', 'CarreraController@activar');

Route::get('/grado','GradoController@index');
Route::post('/grado/registrar', 'GradoController@store');
Route::get('/grado/selectNivel', 'NiveleController@selectNivel');
Route::get('/grado/selectCarrera', 'CarreraController@selectCarrera');
Route::get('/grado/selectSeccion', 'SeccioneController@selectSeccion');
Route::put('/grado/actualizar', 'GradoController@update');
Route::put('/grado/desactivar', 'GradoController@desactivar');
Route::put('/grado/activar', 'GradoController@activar');

Route::get('/asignarDocente','Asignar_docenteController@index');
Route::get('/asignarDocente/selectDocente','PersonaController@buscarDocente');
Route::get('/asignarDocente/selectMateria','MateriaController@buscarMateria');
Route::post('/asignarDocente/registrar', 'Asignar_docenteController@store');
Route::put('/asignarDocente/actualizar', 'Asignar_docenteController@update');

Route::get('/asignarmateria','Asignar_MateriaController@index');
Route::get('/asignarmateria/selectGrado','Asignar_MateriaController@selectGrado');
Route::get('/asignarmateria/selectNivel','Asignar_MateriaController@selectNivel');
Route::get('/asignarmateria/selectMateria','Asignar_MateriaController@selectMateria');
Route::post('/asignarmateria/registrar', 'Asignar_MateriaController@store');
Route::put('/asignarmateria/actualizar', 'Asignar_MateriaController@update');
Route::put('/asignarmateria/activar', 'Asignar_MateriaController@activar');
Route::put('/asignarmateria/desactivar', 'Asignar_MateriaController@desactivar');


Route::get('/asignar-alumnos','Asignar_alumnoController@index');

Route::get('/','Auth\LoginController@showLoginForm');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
