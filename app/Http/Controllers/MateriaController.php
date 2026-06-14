<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Area;
use App\Models\TipoMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with(['area', 'tipo'])->get();

        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $areas = Area::get();
        $tipos = TipoMateria::get();

        return view('materias.create', compact('areas', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'id_areas' => 'required|exists:areas,id_areas',
            'id_tipos' => 'required|exists:tipos_materia,id_tipos',
        ], [
            'nombre.required' => 'El nombre de la materia es obligatorio.',
            'id_areas.required' => 'Debes seleccionar un área para la materia.',
            'id_tipos.required' => 'Debes seleccionar un tipo de materia.',
        ]);

        Materia::create([
            'nombre' => $request->nombre,
            'id_areas' => $request->id_areas,
            'id_tipos' => $request->id_tipos
        ]);

        return redirect()->route('materias.index')->with('success', '¡Materia registrada con éxito!');
    }


}
