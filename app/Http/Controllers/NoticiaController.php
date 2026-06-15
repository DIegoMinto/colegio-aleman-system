<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->get();
        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'contenido' => 'required|string',
            'archivo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'contenido.required' => 'El cuerpo de la noticia es obligatorio.',
            'archivo.mimes' => 'Solo se permiten formatos JPG, PNG o PDF.',
            'archivo.max' => 'El archivo no debe superar los 5MB.',
        ]);

        $archivoUrl = null;
        $tipoArchivo = null;

        // Si el profesor adjuntó un archivo
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $extension = $file->getClientOriginalExtension();

            $tipoArchivo = ($extension === 'pdf') ? 'pdf' : 'imagen';

            $path = Storage::disk('s3')->put('noticias', $file, 'public');

            $archivoUrl = Storage::disk('s3')->url($path);
        }

        // Guardamos todo en PostgreSQL
        Noticia::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'archivo_url' => $archivoUrl,
            'tipo_archivo' => $tipoArchivo,
        ]);

        return redirect()->route('noticias.index')->with('success', '¡Noticia escolar publicada con éxito!');
    }
}