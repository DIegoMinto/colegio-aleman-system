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
            'archivo' => 'nullable',
        ]);

        $archivoUrl = null;
        $tipoArchivo = null;

        try {
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $extension = strtolower($file->getClientOriginalExtension());

                $tipoArchivo = ($extension === 'pdf') ? 'pdf' : 'imagen';

                $path = Storage::disk('s3')->put('noticias', $file, 'public');

                $archivoUrl = Storage::disk('s3')->url($path);
            }

            Noticia::create([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'archivo_url' => $archivoUrl,
                'tipo_archivo' => $tipoArchivo,
            ]);

            return redirect()->route('noticias.index')->with('success', '¡Noticia escolar publicada con éxito!');

        } catch (\Exception $e) {
            dd([
                'Mensaje de Error' => $e->getMessage(),
                'Archivo donde Falló' => $e->getFile(),
                'Línea del Error' => $e->getLine()
            ]);
        }
    }
}