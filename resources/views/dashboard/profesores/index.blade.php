<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores - Colegio Boliviano Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Profesores - SGA Colegio Alemán')

    @section('content')

        <div class="container mx-auto space-y-6 p-4">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Profesores
                </h1>
                <a href="{{ route('profesores.create') }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                    + Registrar Profesor
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
                            <th class="px-6 py-4">Nombres</th>
                            <th class="px-6 py-4">Apellidos</th>
                            <th class="px-6 py-4">CI</th>
                            <th class="px-6 py-4">Celular</th>
                            <th class="px-6 py-4">Usuario</th>
                            <th class="px-6 py-4">Email</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($docentes as $docente)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $docente->persona->nombres ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $docente->persona->apellido_p ?? '' }}
                                    {{ $docente->persona->apellido_m ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $docente->persona->ci ?? '—' }}
                                    {{ $docente->persona->extension_ci ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $docente->persona->celular ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $docente->persona->usuario->user ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $docente->persona->usuario->email ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    No hay profesores registrados.
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