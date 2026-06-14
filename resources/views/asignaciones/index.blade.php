<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones - Colegio Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Asignaciones - Colegio Alemán')

    @section('content')
        <div class="container mx-auto space-y-6 p-4">

            {{-- Encabezado --}}
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Asignaciones Docentes
                </h1>
                <a href="{{ route('asignaciones.create') }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                    + Nueva Asignación
                </a>
            </div>

            {{-- Alerta de éxito --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabla --}}
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">N°</th>
                            <th class="px-6 py-4">Docente</th>
                            <th class="px-6 py-4">Curso / Paralelo</th>
                            <th class="px-6 py-4">Materia</th>
                            <th class="px-6 py-4">Gestión</th>
                            <th class="px-6 py-4">Operaciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($asignaciones as $asignacion)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    @if(isset($asignacion->docente->persona))
                                        {{ $asignacion->docente->persona->apellido_p }}
                                        {{ $asignacion->docente->persona->apellido_m ?? '' }}
                                        {{ $asignacion->docente->persona->nombres }}
                                    @else
                                        <span class="text-gray-400 italic">Docente no asignado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $asignacion->curso->nombre ?? '—' }} {{ $asignacion->curso->paralelo ?? '' }}
                                    <span class="text-xs text-gray-400">({{ $asignacion->curso->nivel ?? '—' }})</span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $asignacion->materia->nombre ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-semibold">
                                    {{ $asignacion->gestion ?? '—' }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('asignaciones.edit', $asignacion->id_asignaciones) }}"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-dark-yellow rounded-lg hover:opacity-80 transition">
                                            Editar
                                        </a>
                                        <button type="button"
                                            onclick="abrirModalEliminar({{ $asignacion->id_asignaciones }}, 'Asignación de {{ $asignacion->materia->nombre ?? 'Materia' }}')"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded-lg hover:opacity-80 transition">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                    No hay asignaciones académicas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    @endsection
</body>

</html>