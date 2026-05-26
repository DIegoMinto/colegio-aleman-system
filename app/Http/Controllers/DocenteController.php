<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
}