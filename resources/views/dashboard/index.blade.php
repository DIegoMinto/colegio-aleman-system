<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio - Colegio Boliviano Alemán</title>
</head>

<body>
    @extends('layouts.dashboard')

    @section('title', 'Inicio - SGA Colegio Alemán')

    @section('content')

        <div class="container mx-auto space-y-6">

            <div class="relative w-full h-64 md:h-80 rounded-sm overflow-hidden shadow-md group">

                <img src="img/background_colegio.png" alt="Colegio Alemán" class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-6 md:p-8 text-white">
                    <h1 class="txt-title-main uppercase tracking-wide drop-shadow-md text-white">
                        Los valores son amigos que en la vida
                        te ayudan a ser feliz. 
                    </h1>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6 items-start">

                <div
                    class="lg:col-span-1 bg-gray-200 rounded-2xl shadow-sm p-6 flex flex-col justify-between h-full border border-gray-100">

                    <div class="w-32 h-40 bg-gray-100 rounded-xl overflow-hidden mb-4">
                        <img src="/img/cardenal_maurer.png" alt="Cardenal José Clemente Maurer"
                            class="w-full h-full object-cover">
                    </div>

                    <h2 class="text-xl font-bold text-dark-red uppercase tracking-wide">
                        Cardenal José Clemente Maurer
                    </h2>
                    <p class="txt-text font-bold text-dark-yellow tracking-widest mt-0.5 mb-4">
                        1900 - 1990
                    </p>

                    <p class="txt-text text-black leading-relaxed text-justify">
                        José Clemente Maurer Clements, nació en Alemania en el poblado de El Sarré en el estado de
                        Püttlingen, el 13 de marzo de 1900 en una familia modesta de mineros, sus padres fueron Pedro
                        Maurer y Ángela Clements, sus hermanos fueron Meter y Susana. Sus medios hermanos eran Johann,
                        Catarina y Meter que fueron los mayores, se bautizó el 18 de marzo en el templo parroquial de
                        San Miguel.
                    </p>


                    <div class="mt-6">
                        <a href="#"
                            class="inline-flex items-center text-sm font-bold text-dark-red hover:text-red-700 transition group">
                            Conocer Historia →
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6 flex flex-col justify-between h-full">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="relative h-64 rounded-2xl overflow-hidden shadow-sm group">
                            <img src="/img/mision_fondo.png" alt="Misión" class="">

                            <div class="absolute inset-0 p-6 flex flex-col justify-start">
                                <h3 class="text-dark-red text-lg uppercase font-bold pb-2">
                                    Nuestra Misión
                                </h3>
                                <p class="txt-text text-black">
                                    Crear y desarrollar procesos educativos de excelencia iluminados de la Pedagogía de
                                    Jesucristo, en quien todos los valores humanos encuentran su plena realización.
                                </p>
                            </div>
                        </div>

                        <div class="relative h-64 rounded-2xl overflow-hidden shadow-sm group">
                            <img src="/img/vision_fondo.png" alt="Visión">

                            <div class="absolute inset-0 p-6 flex flex-col justify-start z-10">
                                <h3 class="text-dark-yellow text-lg uppercase font-bold pb-2">
                                    Nuestra Visión
                                </h3>
                                <p class="txt-text text-white">
                                    Contribuir a la formación integral de las personas y comunidades, acorde con la
                                    perspectiva liberadora del Evangelio.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex-1 min-h-[180px] flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <p class="label-text text-gray-400">Valores</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    @endsection
</body>

</html>