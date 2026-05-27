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
                            <th class="px-6 py-4">Operaciones</th>
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
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('profesores.edit', $docente->id_docentes) }}"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-dark-yellow rounded-lg hover:opacity-80 transition">
                                            Editar
                                        </a>
                                        <button type="button"
                                            onclick="abrirModalEliminar({{ $docente->id_docentes }}, '{{ $docente->persona->nombres ?? '' }} {{ $docente->persona->apellido_p ?? '' }}')"
                                            class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded-lg hover:opacity-80 transition">
                                            Eliminar
                                        </button>
                                    </div>
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
        <div id="modal-eliminar" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md mx-4">

                <h2 class="text-lg font-bold text-dark-red uppercase tracking-wide mb-1">Eliminar Profesor</h2>
                <p class="text-sm text-gray-500 mb-4">
                    Estás por eliminar a <span id="modal-nombre" class="font-semibold text-gray-700"></span>.
                    Esta acción no se puede deshacer.
                </p>

                <form id="form-eliminar" method="POST" class="space-y-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                            Ingresa tu contraseña para confirmar
                        </label>
                        <input type="password" name="password_confirm"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-300"
                            placeholder="Tu contraseña">

                        @error('password_confirm')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" onclick="cerrarModal()"
                            class="px-5 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:opacity-90 transition">
                            Sí, eliminar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function abrirModalEliminar(id, nombre) {
                document.getElementById('modal-nombre').textContent = nombre;
                document.getElementById('form-eliminar').action = `/profesores/${id}`;
                document.getElementById('modal-eliminar').classList.remove('hidden');
            }

            function cerrarModal() {
                document.getElementById('modal-eliminar').classList.add('hidden');
            }

            document.getElementById('modal-eliminar').addEventListener('click', function (e) {
                if (e.target === this) cerrarModal();
            });
        </script>
    @endsection
</body>

</html>