<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    public function handle($request, $next)
    {
        if (Auth::check()) {
            return redirect()->route('inicio');
        }

        return $next($request);
    }
}