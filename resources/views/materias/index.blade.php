<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias - Colegio Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Materias - Colegio Alemán')

    @section('content')
        <div class="container mx-auto space-y-6 p-4">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Materias
                </h1>
                <a href="{{ route('materias.create') }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                    + Añadir Materia
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">N°</th>
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Área</th>
                            <th class="px-6 py-4">Tipo</th>
                            <th class="px-6 py-4">Operaciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($materias as $materia)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $materia->nombre ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $materia->area->nombre ?? 'Sin Área' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $materia->tipo->nombre ?? 'Sin Tipo' }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('materias.edit', $materia->id_materias) }}"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-dark-yellow rounded-lg hover:opacity-80 transition">
                                            Editar
                                        </a>
                                        <button type="button"
                                            onclick="abrirModalEliminar({{ $materia->id_materias }}, '{{ $materia->nombre ?? '' }}')"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded-lg hover:opacity-80 transition">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                    No hay materias registradas.
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