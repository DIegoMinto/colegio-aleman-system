<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::get();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'nivel' => 'required|string|max:50',
            'paralelo' => 'required|string|max:10',
        ], [
            'nombre.required' => 'El nombre del curso es obligatorio.',
            'nivel.required' => 'El nivel (ej. Primaria, Secundaria) es obligatorio.',
            'paralelo.required' => 'El paralelo es obligatorio.',
        ]);

        Curso::create([
            'nombre' => $request->nombre,
            'nivel' => $request->nivel,
            'paralelo' => $request->paralelo,
        ]);

        return redirect()->route('cursos.index')->with('success', '¡Curso creado con éxito!');
    }
}
