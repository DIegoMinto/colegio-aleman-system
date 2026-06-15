<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

        try { // <--- AQUÍ ABRE EL TRY
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $extension = strtolower($file->getClientOriginalExtension());
                $tipoArchivo = ($extension === 'pdf') ? 'pdf' : 'imagen';

                $path = $file->store('noticias', 's3');

                if (!$path) {
                    throw new \Exception('El driver de S3 no devolvió un path válido.');
                }

                $archivoUrl = Storage::disk('s3')->url($path);
            } // <--- CIERRA EL IF DEL ARCHIVO

            Noticia::create([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'archivo_url' => $archivoUrl,
                'tipo_archivo' => $tipoArchivo,
            ]);

            return redirect()->route('noticias.index')->with('success', '¡Noticia escolar publicada con éxito!');

        } // <--- ¡OJO AQUÍ! Esta llave DEBE cerrar el bloque try justo antes del catch
        catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Algo falló.');
        }
    }
}