<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Materia;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with(['docente.persona', 'curso', 'materia'])->get();

        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $docentes = Docente::with('persona')->get();
        $cursos = Curso::get();
        $materias = Materia::get();


        return view('asignaciones.create', compact('docentes', 'cursos', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_docentes' => 'required|exists:docentes,id_docentes',
            'id_cursos' => 'required|exists:cursos,id_cursos',
            'id_materias' => 'required|exists:materias,id_materias',
            'gestion' => 'required|integer|min:2020|max:2099',
        ], [
            'id_docentes.required' => 'Debe seleccionar un docente.',
            'id_cursos.required' => 'Debe seleccionar un curso.',
            'id_materias.required' => 'Debe seleccionar una materia.',
            'gestion.required' => 'La gestión (año) es obligatoria.',
        ]);

        Asignacion::create([
            'id_docentes' => $request->id_docentes,
            'id_cursos' => $request->id_cursos,
            'id_materias' => $request->id_materias,
            'gestion' => $request->gestion,
        ]);

        return redirect()->route('asignaciones.index')->with('success', '¡Asignación académica registrada con éxito!');
    }
}