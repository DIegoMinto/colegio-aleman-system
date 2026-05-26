<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Colegio Alemán</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="min-h-screen flex flex-col md:flex-row shadow-lg overflow-hidden">

        <div class="w-full md:w-1/2 bg-cover bg-center" style="background-image: url('/img/tu-fondo.jpg');">

            <div
                class="hidden md:flex flex-col justify-between items-center h-full text-center p-12 bg-dark-red text-white">

                <div class="flex flex-col items-center justify-center">
                    <img src="img/aleman_escudo.png" alt="Logo Colegio Alemán" class="w-50 mb-6">
                    <h2 class="text-2xl font-bold tracking-wide">
                        COLEGIO BOLIVIANO ALEMÁN <br> CARDENAL MAURER
                    </h2>
                </div>
                <div class="mt-auto w-full flex flex-col sm:flex-row justify-between items-start pt-6 ">
                    <div class="text-left">
                        <p class="txt-text font-bold text-dark-yellow mb-1 uppercase tracking-wider">
                            Nuestra Misión
                        </p>
                        <p class=" text-sm leading-relaxed text-gray-100">
                            Crear y desarrollar procesos educativos de excelencia iluminados de la Pedagogía de
                            Jesucristo, en quien todos los valores humanos encuentran su plena realización.
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="txt-text font-bold text-dark-yellow mb-1 uppercase tracking-wider">
                            Nuestra Visión
                        </p>
                        <p class="text-sm leading-relaxed text-gray-100">
                            Contribuir a la formación integral de las personas y comunidades, acorde con la perspectiva
                            liberadora del Evangelio.
                        </p>
                    </div>

                </div>

            </div>
        </div>

        <div class="w-full md:w-1/2 flex flex-col items-center bg-white min-h-screen md:min-h-full">

            <div class="w-full">
                <img src="img/login_header.png" alt="Header Login" class="w-full object-cover">
            </div>

            <div class="w-full max-w-md p-8 md:p-10 flex flex-col justify-center">

                <h1 class="txt-title-main mb-6">
                    WILKOMMEN
                </h1>
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/login" method="POST">
                    @csrf

                    <div class="txt-text mb-6">
                        Mensaje de prueba para ver el deploy
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 label-text">
                            Usuario
                        </label>
                        <input type="text" name="user" class="form-input-text w-full">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 label-text">
                            Contraseña
                        </label>
                        <input type="password" name="password" class="form-input-text w-full">
                    </div>

                    <div class="flex justify-center items-center mb-8">
                        <button type="submit" class="btn-red w-50">
                            INICIAR SESION
                        </button>
                    </div>
                </form>

                <div class="mt-auto flex items-center justify-center">
                    <div class="mr-5">
                        <img src="img/alert_icon.png" alt="Alerta">
                    </div>
                    <div class="txt-text">
                        Si tiene problemas con el inicio de sesión por favor comuníquese con administración.
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>