<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MundoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'App\Http\Middleware\AuthAdmin'], function () {
    Route::get('/usuario', [UsuarioController::class, 'usuarios'])->name('usuario');

    Route::get('/mundo', [MundoController::class, 'create'])->name('mundo');
    Route::get('/mundo/{id}/editar', [MundoController::class, 'editarMundo'])->name('editar-mundo');

    Route::get('/mundo/{idMundo}/nivel', [NivelController::class, 'subirNiveles'])->name('subir-nivel');
    Route::get('/mundo/{idMundo}/niveles', [NivelController::class, 'mostrarNiveles'])->name('subir-nivel');
    Route::get('/mundo/{idMundo}/nivel/{idNivel}/editar', [NivelController::class, 'editarNivel'])->name('editar-nivel');

    Route::post('/registrar-mundo', [MundoController::class, 'registrarMundo'])->name('registrar-mundo');
    Route::post('/mundo/{id}/nivel/registrar', [NivelController::class, 'registrarNivel'])->name('registrar-nivel');

    Route::put('/mundo/{id}/actualizar', [MundoController::class, 'actualizarMundo'])->name('actualizar-mundo');
    Route::put('/mundo/{id_mundo}/nivel/{id_nivel}', [NivelController::class, 'ActualizarNivel'])->name('actualizar-nivel');

    Route::delete('/mundo/{id}', [MundoController::class, 'eliminarMundo'])->name('eliminar-mundo');
    Route::delete('/nivel/{id}', [NivelController::class, 'eliminarNivel'])->name('eliminar-nivel');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [LoginController::class, 'imagen'])->name('inicio');
    Route::get('/mundo', [MundoController::class, 'mundos'])->name('mundo');
    Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'iniciosesion')->name('iniciosesion');
    Route::view('/registro', 'registro')->name('registro');
    Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
    Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
});