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

        try {
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $extension = strtolower($file->getClientOriginalExtension());

                $tipoArchivo = ($extension === 'pdf') ? 'pdf' : 'imagen';

                // Subida limpia a S3 (retorna el path exacto como un string robusto)
                $path = $file->store('noticias', 's3');

                if (!$path) {
                    throw new \Exception('El driver de S3 no devolvió un path válido al guardar el archivo.');
                }

                // Generamos la URL final en AWS
                $archivoUrl = Storage::disk('s3')->url($path);
            }

            // Guardamos el registro en la base de datos
            Noticia::create([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'archivo_url' => $archivoUrl,
                'tipo_archivo' => $tipoArchivo,
            ]);

            return redirect()->route('noticias.index')->with('success', '¡Noticia escolar publicada con éxito!');

        } catch (\Exception $e) {
            // En producción guarda el error en el log interno sin romper la pantalla
            Log::error('Error al subir noticia a S3 o BD: ' . $e->getMessage(), [
                'archivo' => $e->getFile(),
                'linea' => $e->getLine()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Hubo un problema al procesar la noticia. Revisa la configuración de almacenamiento.');
        }
    }
}