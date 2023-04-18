<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Actividad</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        <div class="contenido">
            <a href="{{ route('inicio') }}">
                <button class="atras">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                    <span>Atras</span>
                </button>
            </a>
            <div class="row">
                <div class="iframe-container">
                    <iframe
                        src="{{ URL::to('/') . '/actividades/' . $actividad[0]->id . '/' . $actividad[0]->archivo }}"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <x-foot />
</body>

</html>
