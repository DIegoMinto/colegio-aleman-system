<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Colegio Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Noticias y Comunicados - Colegio Alemán')

    @section('content')
        <div class="container mx-auto space-y-6 p-4">

            {{-- Encabezado del Módulo --}}
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                        Noticias e Informaciones
                    </h1>
                    <p class="text-xs text-gray-400">Muro de comunicados oficiales del establecimiento</p>
                </div>

                {{-- Botón de Crear Noticia --}}
                <a href="{{ route('noticias.create') }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition shadow-sm">
                    + Nueva Noticia
                </a>
            </div>

            {{-- Alerta de éxito --}}
            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl px-4 py-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Contenedor de Noticias (Grid Dinámico) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($noticias as $noticia)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition duration-300">

                        {{-- Renderizado Inteligente de Multimedia desde AWS S3 --}}
                        @if ($noticia->archivo_url)
                            @if ($noticia->tipo_archivo === 'imagen')
                                <div class="w-full h-48 overflow-hidden bg-gray-50 border-b border-gray-100">
                                    <img src="{{ $noticia->archivo_url }}" alt="{{ $noticia->titulo }}"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                </div>
                            @else
                                {{-- Preview elegante si es un PDF --}}
                                <div
                                    class="w-full h-32 bg-red-50/50 border-b border-gray-100 flex flex-col items-center justify-center gap-2 p-4">
                                    <span class="text-3xl">📄</span>
                                    <span
                                        class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-0.5 rounded-full uppercase">Documento
                                        PDF</span>
                                </div>
                            @endif
                        @else
                            {{-- Placeholder visual si la noticia es puramente texto --}}
                            <div class="w-full h-12 bg-gradient-to-r from-dark-red/5 to-transparent border-b border-gray-50"></div>
                        @endif

                        {{-- Cuerpo de la Noticia --}}
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div class="space-y-2">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                    📅 Publicado el {{ $noticia->created_at->format('d/m/Y') }}
                                </span>
                                <h2 class="text-base font-bold text-gray-800 line-clamp-2 leading-snug">
                                    {{ $noticia->titulo }}
                                </h2>
                                <p class="text-sm text-gray-500 line-clamp-4 leading-relaxed whitespace-pre-line">
                                    {{ $noticia->contenido }}
                                </p>
                            </div>

                            {{-- Botón de acción para Recursos Adjuntos --}}
                            @if ($noticia->archivo_url && $noticia->tipo_archivo === 'pdf')
                                <div class="pt-2 border-t border-gray-50">
                                    <a href="{{ $noticia->archivo_url }}" target="_blank"
                                        class="inline-flex items-center gap-2 text-xs font-bold text-dark-red hover:text-opacity-80 transition">
                                        Descargar Documento Adjunto →
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                @empty
                    {{-- Estado Vacío --}}
                    <div
                        class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm">
                        <div class="text-4xl mb-3">📢</div>
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">No hay publicaciones</h3>
                        <p class="text-sm text-gray-400 mt-1">El tablero de noticias escolar se encuentra vacío en este momento.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    @endsection
</body>

</html>