@extends('layouts.dashboard')

@section('title', 'Publicar Noticia - Colegio Alemán')

@section('content')
    <div class="container mx-auto space-y-6 p-4 max-w-4xl">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">Publicar Noticia</h1>
            <a href="{{ route('noticias.index') }}"
                class="text-sm text-gray-500 hover:text-dark-red transition font-medium">← Volver</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </div>
        @endif

        <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Título de la Noticia *</label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Contenido / Descripción
                        *</label>
                    <textarea name="contenido" rows="5"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                        placeholder="Escribe el comunicado para el colegio...">{{ old('contenido') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Adjuntar Recurso (Imagen o
                        PDF)</label>
                    <input type="file" name="archivo"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    <span class="text-xs text-gray-400 block mt-1">Formatos válidos: JPG, JPEG, PNG, PDF. Tamaño máximo:
                        5MB</span>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('noticias.index') }}"
                    class="px-6 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Cancelar</a>
                <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">Publicar</button>
            </div>
        </form>
    </div>
@endsection