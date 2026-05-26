<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Colegio Alemán')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="white font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white text-dark-red transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0">

            <div class="bg-white bg-opacity-20  p-6 ">
                <div class="flex justify-center">
                    <img src="/img/aleman_escudo.png" alt="Logo" class="w-30 mb-3">

                </div>
                <span class="txt-text font-bold tracking-wider text-dark-red flex justify-center">Plataforma
                    Institucional</span>
                <span class="text-sm font-bold tracking-wider text-gray-500 flex justify-center">Colegio Boliviano
                    Alemán </span>

            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto text-gray-500">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Inicio</span>
                </a>
                <a href="#" class="{{ request()->routeIs('horarios*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Horarios</span>
                </a>
                <a href="#"
                    class="{{ request()->routeIs('calificaciones*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Calificaciones</span>
                </a>
                <a href="#" class="{{ request()->routeIs('asistencia*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Asistencia</span>
                </a>
                <a href="{{ route('profesores.index') }}"
                    class="{{ request()->routeIs('profesores*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Profesores</span>
                </a>
                <a href="#" class="{{ request()->routeIs('asignaciones*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <span class="ml-3">Asignaciones</span>
                </a>
            </nav>

            <div class="p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex w-full items-center sidebar-link">
                        <span class="ml-3">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden md:hidden"></div>
        <div class="flex flex-col flex-1 w-full overflow-y-auto">

            <header
                class="flex items-center justify-between h-16 px-6 py-3 bg-white border-b border-gray-200 sticky top-0 z-30">

                <button id="btn-toggle-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden">

                </button>
                <div class="hidden sm:block text-sm font-medium text-dark-red ">
                    COLEGIO BOLIVIANO ALEMÁN CARDENAL MAURER
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-xs text-dark-yellow font-medium uppercase">{{ session('usuario_rol') }}</p>
                        <p class="text-sm font-semibold text-gray-700">{{ session('usuario_user') }}</p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-dark-red flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(session('usuario_user', 'U'), 0, 2)) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 p-2">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const btnToggle = document.getElementById('btn-toggle-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        btnToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>

</html>