<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Editar Profesor - SGA Colegio Alemán')

    @section('content')

        <div class="container mx-auto space-y-6 p-4 max-w-4xl">

            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                    Editar Profesor
                </h1>
                <a href="{{ route('profesores.index') }}"
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

            <form action="{{ route('profesores.update', $docente->id_docentes) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">

                    <h2 class="text-sm font-bold text-dark-red uppercase tracking-widest border-b border-gray-100 pb-2">
                        Datos Personales
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nombres *</label>
                            <input type="text" name="nombres" value="{{ old('nombres', $docente->persona->nombres) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Apellido Paterno
                                *</label>
                            <input type="text" name="apellido_p"
                                value="{{ old('apellido_p', $docente->persona->apellido_p) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Apellido Materno</label>
                            <input type="text" name="apellido_m"
                                value="{{ old('apellido_m', $docente->persona->apellido_m) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Fecha de Nacimiento
                                *</label>
                            <input type="date" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $docente->persona->fecha_nacimiento) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">CI *</label>
                            <input type="text" name="ci" value="{{ old('ci', $docente->persona->ci) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Extensión CI *</label>
                            <select name="extension_ci"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                @foreach (['LP', 'SC', 'CB', 'OR', 'PT', 'TJ', 'BE', 'PD', 'CH'] as $ext)
                                    <option value="{{ $ext }}" {{ old('extension_ci', $docente->persona->extension_ci) == $ext ? 'selected' : '' }}>
                                        {{ $ext }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Celular</label>
                            <input type="text" name="celular" value="{{ old('celular', $docente->persona->celular) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Domicilio</label>
                            <input type="text" name="domicilio" value="{{ old('domicilio', $docente->persona->domicilio) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Departamento de
                                Residencia</label>
                            <select name="departamento_residencia"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                                <option value="">Seleccionar</option>
                                @foreach (['La Paz', 'Santa Cruz', 'Cochabamba', 'Oruro', 'Potosí', 'Tarija', 'Beni', 'Pando', 'Chuquisaca'] as $dep)
                                    <option value="{{ $dep }}" {{ old('departamento_residencia', $docente->persona->departamento_residencia) == $dep ? 'selected' : '' }}>
                                        {{ $dep }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">

                    <h2 class="text-sm font-bold text-dark-red uppercase tracking-widest border-b border-gray-100 pb-2">
                        Credenciales de Acceso
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $docente->persona->usuario->email) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nombre de Usuario
                                *</label>
                            <input type="text" name="user" value="{{ old('user', $docente->persona->usuario->user) }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                                Nueva Contraseña
                                <span class="text-gray-400 normal-case font-normal">(dejar vacío para no cambiar)</span>
                            </label>
                            <input type="password" name="password"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                                placeholder="Nueva contraseña">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Confirmar
                                Contraseña</label>
                            <input type="password" name="password_confirmation"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-dark-red/30"
                                placeholder="Repetir nueva contraseña">
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('profesores.index') }}"
                        class="px-6 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-semibold text-white bg-dark-red rounded-lg hover:opacity-90 transition">
                        Guardar Cambios
                    </button>
                </div>

            </form>

        </div>

    @endsection
</body>

</html>