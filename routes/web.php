<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::view('/inicio', 'inicio')->name('inicio');
});

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'iniciosesion')->name('iniciosesion');
});