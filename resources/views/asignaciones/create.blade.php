<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Asignación - Colegio Boliviano Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Nueva Asignación - SGA Colegio Alemán')

    @section('content')

        <div class="container mx-auto space-y-6 p-4 max-w-4xl">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Nueva Asignación Académica
                </h1>
                <a href="{{ route('asignaciones.index') }}"
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

            <form action="{{ route('asignaciones.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">

                    <h2 class="text-sm font-bold text-dark-red uppercase tracking-widest border-b border-gray-100 pb-2">
                        Distribución de Carga Horaria
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Docente *</label>
                            <select name="id_docentes"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                <option value="">Seleccionar Docente</option>
                                @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id_docentes }}" {{ old('id_docentes') == $docente->id_docentes ? 'selected' : '' }}>
                                        {{-- Cambia esto si los nombres están directo en la tabla docentes sin pasar por persona
                                        --}}
                                        {{ $docente->persona->apellido_p ?? '' }} {{ $docente->persona->apellido_m ?? '' }}
                                        {{ $docente->persona->nombres ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Curso Asignado *</label>
                            <select name="id_cursos"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                <option value="">Seleccionar Curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id_cursos }}" {{ old('id_cursos') == $curso->id_cursos ? 'selected' : '' }}>
                                        {{ $curso->nombre }} "{{ $curso->paralelo }}" - {{ $curso->nivel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Materia *</label>
                            <select name="id_materias"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                <option value="">Seleccionar Materia</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id_materias }}" {{ old('id_materias') == $materia->id_materias ? 'selected' : '' }}>
                                        {{ $materia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Gestión (Año) *</label>
                            <input type="number" name="gestion" value="{{ old('gestion', date('Y')) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                                placeholder="Ej: 2026">
                        </div>

                    </div>

                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('asignaciones.index') }}"
                        class="px-6 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                        Registrar Asignación
                    </button>
                </div>

            </form>

        </div>

    @endsection
</body>

</html>