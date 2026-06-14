<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cursos - Colegio Boliviano Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Registrar Curso - Colegio Alemán')

    @section('content')

        <div class="container mx-auto space-y-6 p-4 max-w-4xl">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Registrar Curso
                </h1>
                <a href="{{ route('cursos.index') }}"
                    class="text-sm text-gray-500 hover:text-dark-red transition font-medium">
                    ← Volver
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <p class="text-sm font-semibold text-red-600 mb-2">Por favor corrige los siguientes errores:</p>
                    <ul class="text-sm text-red-500 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cursos.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">

                    <h2 class="text-sm font-bold text-dark-red uppercase tracking-widest border-b border-gray-100 pb-2">
                        Datos del Curso
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nombre del Curso
                                *</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                                placeholder="Ej: Primero, Segundo...">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nivel *</label>
                            <select name="nivel"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                <option value="">Seleccionar Nivel</option>
                                <option value="Primaria" {{ old('nivel') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                <option value="Secundaria" {{ old('nivel') == 'Secundaria' ? 'selected' : '' }}>Secundaria
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Paralelo *</label>
                            <input type="text" name="paralelo" value="{{ old('paralelo') }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                                placeholder="Ej: A, B, C...">
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('cursos.index') }}"
                        class="px-6 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                        Registrar Curso
                    </button>
                </div>

            </form>

        </div>

    @endsection
</body>

</html>