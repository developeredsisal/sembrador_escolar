<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MundoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'App\Http\Middleware\AuthAdmin'], function () {
    Route::get('/mundo', [MundoController::class, 'create'])->name('mundo');
    // Route::get('/lectura', [LecturaController::class, 'create'])->name('lectura');
    Route::get('/usuario', [UsuarioController::class, 'usuarios'])->name('usuario');
    // Route::get('/lectura/{id}/editar', [LecturaController::class, 'editarLectura'])->name('editar-lectura');
    Route::get('/mundo/{id}/editar', [MundoController::class, 'editarMundo'])->name('editar-mundo');
    Route::get('/mundo/{id}/nivel/', [NivelController::class, 'subir'])->name('subir-nivel');
    // Route::get('/lectura/{id}/actividad', [ActividadController::class, 'subir'])->name('subir-actividad');
    // Route::get('/lectura/{id}/actividades/ver', [LecturaController::class, 'verActividades'])->name('ver-actividades');
    Route::get('/mundo/{id}/niveles', [NivelController::class, 'mostrarNiveles'])->name('subir-nivel');
    // Route::get('/lectura/{id}/actividades', [ActividadController::class, 'mostrarActividades'])->name('subir-actividad');
    Route::get('/mundo/{mundo_id}/niveles/{nivel_id}/editar', [NivelController::class, 'editarNivel'])->name('editar-nivel');
    // Route::get('/lectura/{lectura_id}/actividades/{actividad_id}/editar', [ActividadController::class, 'editarActividad'])->name('editar-actividad');

    Route::post('/registrar-mundo', [MundoController::class, 'registrarMundo'])->name('registrar-mundo');
    // Route::post('/registrar-lectura', [LecturaController::class, 'registrar'])->name('registrar-lectura');
    Route::post('/mundo/{id}/nivel/registrar', [NivelController::class, 'registrarNivel'])->name('registrar-nivel');
    // Route::post('/lectura/{id}/actividad/registrar', [ActividadController::class, 'registrarActividad'])->name('registrar-actividad');

    Route::put('/mundo/{id}/actualizar', [MundoController::class, 'actualizarMundo'])->name('actualizar-mundo');
    // Route::put('/lectura/{id}/actualizar', [LecturaController::class, 'actualizarLectura'])->name('actualizar-lectura');
    Route::put('/mundo/{mundo_id}/niveles/{nivel_id}/actualizar', [NivelController::class,'actualizarNivel'])->name('actualizar-nivel');
    // Route::put('/lectura/{lectura_id}/actividades/{actividad_id}/actualizar', [ActividadController::class,'actualizarActividad'])->name('actualizar-actividad');

    Route::delete('/mundo/{id}', [MundoController::class, 'eliminarMundo'])->name('eliminar-mundo');
    // Route::delete('/lectura/{id}', [LecturaController::class, 'eliminar'])->name('eliminar-lectura');
    Route::delete('/nivel/{id}', [NivelController::class, 'eliminarNivel'])->name('eliminar-nivel');
    // Route::delete('/actividad/{id}', [ActividadController::class, 'eliminarActividad'])->name('eliminar-actividad');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [LoginController::class, 'imagen'])->name('inicio');
    // Route::get('/actividad/{id}', [ActividadController::class, 'actividad'])->name('actividad');
    // Route::get('/lectura', [LecturaController::class, 'lecturas'])->name('lectura');
    Route::get('/mundo', [MundoController::class, 'mundos'])->name('mundo');
    Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'iniciosesion')->name('iniciosesion');
    Route::view('/registro', 'registro')->name('registro');
    Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
    Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
});