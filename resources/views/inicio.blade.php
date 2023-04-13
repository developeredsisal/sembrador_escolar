<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Inicio</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        @role('admin')
        <div class="contenido">
            <h1>Administrador</h1>
        </div>
        @endrole
        @role('Grado 1')
        <div class="contenido">
            <h1>Primero</h1>
        </div>
        @endrole
        @role('Grado 2')
        <div class="contenido">
            <h1>Segundo</h1>
        </div>
        @endrole
    </section>
    <x-foot />
</body>

</html>
