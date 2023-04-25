<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Mundos</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        <div class="contenido">
            <h2>Mundos</h2>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c = 1; ?>
                        @foreach ($mundo as $m)
                            <tr>
                                <td class="text-center">{{ $c++ }}</td>
                                <td data-label="Nombre">{{ $m->nombre }}</td>
                                <td data-label="Grado">{{ $m->grado_nombre }}</td>
                                <td data-label="Imagen"><img class="imagen"
                                        src="{{ URL::to('/') . '/mundos/' . $m->id . '/' . $m->imagen }}"></td>
                                <td data-label="Acciones">
                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                        <div class="btn-group me-2" role="group">
                                            <form action="{{ route('editar-mundo', ['id' => $m->id]) }}" method="GET">
                                                @csrf
                                                @method('UPDATE')
                                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                                    title="Editar">
                                                    <i class="material-icons">border_color</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2 my-2" role="group">
                                            <form action="{{ route('subir-nivel', ['idMundo' => $m->id]) }}
                                                " method="GET">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info" data-toggle="tooltip"
                                                    title="Niveles">
                                                    <i class="material-icons">bookmark_add</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2" role="group">
                                            <form action="{{ route('eliminar-mundo', ['id' => $m->id]) }}" method="POST"
                                                onsubmit="return confirm('¿Está seguro de que desea eliminar el mundo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                    title="Eliminar">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @if (session('success'))
        <div id="ocultar2" class="notificacion">
            <div class="alert alert-success fade show alert-custom" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="ocultar2" class="notificacion">
            <div class="alert alert-danger fade show alert-custom" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <button id="btn-float" class="btn btn-primary btn-float" data-toggle="tooltip" title="Agregar mundos">
        <span class="icon">
            <i class="material-icons">add</i>
        </span>
    </button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">
                <i class="material-icons">cancel</i>
            </span>
            <h4 class="card-title">Crear mundo</h4>
            <x-subirmundo />
        </div>
    </div>
    </div>
    <script src="{{ asset('js/botonflotante.js') }}"></script>
    <x-foot />
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        var alertElement = document.querySelector('.alert');
        if (alertElement) {
            setTimeout(function() {
                alertElement.classList.add('d-none');
            }, 4000);
        }
    </script>
</body>

</html>
