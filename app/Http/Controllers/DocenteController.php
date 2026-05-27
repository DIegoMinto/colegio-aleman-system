<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with(['persona.usuario.rol'])
            ->get();

        return view('dashboard.profesores.index', compact('docentes'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.profesores.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellido_p' => 'required|string|max:50',
            'apellido_m' => 'nullable|string|max:50',
            'ci' => 'required|string|max:20|unique:personas,ci',
            'extension_ci' => 'required|string|max:5',
            'fecha_nacimiento' => 'required|date',
            'domicilio' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:15',
            'departamento_residencia' => 'nullable|string|max:50',
            'email' => 'required|email|unique:usuarios,email',
            'user' => 'required|string|max:50|unique:usuarios,user',
            'password' => 'required|string|min:6|confirmed',
        ]);
        DB::transaction(function () use ($request) {

            $persona = Persona::create([
                'nombres' => $request->nombres,
                'apellido_p' => $request->apellido_p,
                'apellido_m' => $request->apellido_m,
                'ci' => $request->ci,
                'extension_ci' => $request->extension_ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'domicilio' => $request->domicilio,
                'celular' => $request->celular,
                'departamento_residencia' => $request->departamento_residencia,
            ]);

            $rolDocente = Role::where('nombre', 'Profesor')->firstOrFail();

            Usuario::create([
                'email' => $request->email,
                'user' => $request->user,
                'password' => Hash::make($request->password),
                'id_roles' => $rolDocente->id_roles,
                'id_personas' => $persona->id_personas,
            ]);

            Docente::create([
                'id_personas' => $persona->id_personas,
            ]);
        });

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor registrado correctamente.');
    }

    public function destroy(Request $request, Docente $docente)
    {
        $request->validate([
            'password_confirm' => 'required|string',
        ]);

        // Verificar contraseña del usuario logueado
        if (!Hash::check($request->password_confirm, Auth::user()->password)) {
            return back()->withErrors(['password_confirm' => 'Contraseña incorrecta.']);
        }

        DB::transaction(function () use ($docente) {
            $persona = $docente->persona;

            $docente->delete();
            $persona->usuario?->delete();
            $persona->delete();
        });

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor eliminado correctamente.');
    }

    public function edit(Docente $docente)
    {
        $docente->load('persona.usuario');
        return view('dashboard.profesores.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $docente->load('persona.usuario');

        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellido_p' => 'required|string|max:50',
            'apellido_m' => 'nullable|string|max:50',
            'ci' => 'required|string|max:20|unique:personas,ci,' . $docente->persona->id_personas . ',id_personas',
            'extension_ci' => 'required|string|max:5',
            'fecha_nacimiento' => 'required|date',
            'domicilio' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:15',
            'departamento_residencia' => 'nullable|string|max:50',
            'email' => 'required|email|unique:usuarios,email,' . $docente->persona->usuario->id_usuarios . ',id_usuarios',
            'user' => 'required|string|max:50|unique:usuarios,user,' . $docente->persona->usuario->id_usuarios . ',id_usuarios',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        DB::transaction(function () use ($request, $docente) {

            $docente->persona->update([
                'nombres' => $request->nombres,
                'apellido_p' => $request->apellido_p,
                'apellido_m' => $request->apellido_m,
                'ci' => $request->ci,
                'extension_ci' => $request->extension_ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'domicilio' => $request->domicilio,
                'celular' => $request->celular,
                'departamento_residencia' => $request->departamento_residencia,
            ]);

            $dataUsuario = [
                'email' => $request->email,
                'user' => $request->user,
            ];

            if ($request->filled('password')) {
                $dataUsuario['password'] = Hash::make($request->password);
            }

            $docente->persona->usuario->update($dataUsuario);
        });

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor actualizado correctamente.');
    }
}