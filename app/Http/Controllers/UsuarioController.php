<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsuarioController extends Controller
{
    public function usuarios()
    {
        $usuarios = User::with('roles')->get();

        return view('usuario', ['usuarios' => $usuarios]);
    }
}