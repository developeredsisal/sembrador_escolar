<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Inicio</title>
</head>

<body
    style="background-image: url('{{ asset('images/' . session('image_path')) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        @role('admin')
            <div class="contenido">
                <div class="ocultar2">
                    <form class="d-flex ocultar2" role="search">
                        <input class="form-control btn-buscar" type="search" placeholder="Buscar..." aria-label="Search">
                    </form>
                </div>
            </div>
        @endrole
        @role('Grado 1')
            <div class="contenido">
                <div class="ocultar2">
                    <form class="d-flex ocultar2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                    </form>
                </div>
            </div>
        @endrole
        @role('Grado 2')
            <div class="contenido">
                <div class="ocultar2">
                    <form class="d-flex ocultar2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                    </form>
                </div>
            </div>
        @endrole
    </section>
    <x-foot />
</body>

</html>
