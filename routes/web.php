<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'App\Http\Middleware\AuthAdmin'], function () {
    Route::get('lectura', [LecturaController::class, 'create'])->name('lectura');
    Route::get('/usuario', [UsuarioController::class, 'usuarios'])->name('usuario');
    Route::get('lectura/{id}/editar', [LecturaController::class, 'editarLectura'])->name('editar-lectura');
    Route::get('lectura/{id}/actividad', [ActividadController::class, 'subir'])->name('subir-actividad');
    Route::get('lectura/{id}/actividades/ver', [LecturaController::class, 'verActividades'])->name('ver-actividades');
    Route::get('lectura/{id}/actividades', [ActividadController::class, 'mostrarActividades'])->name('subir-actividad');
    Route::get('lectura/{lectura_id}/actividades/{actividad_id}/editar', [ActividadController::class, 'editarActividad'])->name('editar-actividad');

    Route::post('registrar-lectura', [LecturaController::class, 'registrar'])->name('registrar-lectura');
    Route::post('lectura/{id}/actividad/registrar', [ActividadController::class, 'registrarActividad'])->name('registrar-actividad');

    Route::put('lectura/{id}/actualizar', [LecturaController::class, 'actualizarLectura'])->name('actualizar-lectura');
    Route::put('lectura/{lectura_id}/actividades/{actividad_id}/actualizar', [ActividadController::class,'actualizarActividad'])->name('actualizar-actividad');

    Route::delete('lectura/{id}', [LecturaController::class, 'eliminar'])->name('eliminar-lectura');
    Route::delete('actividad/{id}', [ActividadController::class, 'eliminarActividad'])->name('eliminar-actividad');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [LoginController::class, 'imagen'])->name('inicio');
    Route::get('actividad/{id}', [ActividadController::class, 'actividad'])->name('actividad');
    Route::get('lectura', [LecturaController::class, 'lecturas'])->name('lectura');
    Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'iniciosesion')->name('iniciosesion');
    Route::view('/registro', 'registro')->name('registro');
    Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
    Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
});