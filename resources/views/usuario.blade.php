<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Usuarios</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        <div class="contenido">
            <h2>Usuarios</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo electrónico</th>
                            <th scrope="col">Grado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c = 1; ?>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="text-center">{{ $c++ }}</td>
                                <td data-label="Nombre">{{ $usuario->name }}</td>
                                <td data-label="Correo">{{ $usuario->email }}</td>
                                <td data-label="Grado">{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <x-foot />
</body>

</html>
