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
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $role = Role::where('name', 'grado' . $request->input('role'))->first();

        if (!$role) {
            $role = Role::create(['name' => 'grado' . $request->input('role')]);
        }
        $user->assignRole($role);
        $user->save();

        Auth::login($user);
        return redirect('inicio');
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('inicio');
        } else {
            if (!User::where('email', $email)->exists()) {
                $errors['email'] = 'El correo es incorrecto';
            } elseif (!Auth::attempt(['password' => $password])) {
                $errors['password'] = 'La contraseña es incorrecta';
            }

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('iniciosesion'));
    }

    public function imagen()
    {
        $user = auth()->user();
        $role = $user->getRoleNames()[0];
        $imageNames = [
            'admin' => 'admin.svg',
            'grado1' => 'grado1.svg',
            'grado2' => 'grado2.svg',
            'grado3' => 'grado3.svg',
            'grado4' => 'grado4.svg',
            'grado5' => 'grado5.svg',
            'grado6' => 'grado6.svg',
        ];
        $imageName = isset($imageNames[$role]) ? $imageNames[$role] : 'default.svg';
        $imagePath = file_exists(public_path('images/' . $imageName)) ? $imageName : 'default.svg';
    
        session(['image_path' => $imagePath]);
    
        return view('inicio');
    }
}