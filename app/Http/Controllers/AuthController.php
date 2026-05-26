<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);
        $usuario = Usuario::with('rol')
            ->where('user', $request->input('user'))
            ->first();
        if (!$usuario || !Hash::check($request->input('password'), $usuario->password)) {
            return back()
                ->withInput($request->only('user'))
                ->withErrors(['user' => 'Credenciales incorrectas']);
        }
        Auth::login($usuario);
        $request->session()->regenerate();
        session([
            'usuario_id' => $usuario->id_usuarios,
            'usuario_user' => $usuario->user,
            'usuario_rol' => $usuario->rol->nombre,
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
