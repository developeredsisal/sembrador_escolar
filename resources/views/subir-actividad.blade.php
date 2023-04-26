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
            <div class="pb-3">
                <a href="{{ route('subir-lectura', ['idMundo' => $mundo->id, 'idNivel' => $nivel->id]) }}">
                    <button class="atras">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                        </svg>
                        <span>Lecturas</span>
                    </button>
                </a>
            </div>
            <h2>Actividades de la lectura: "{{ $lectura->nombre }}"</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c = 1; ?>
                        @foreach ($actividades as $actividad)
                            <tr>
                                <td class="text-center">{{ $c++ }}</td>
                                <td data-label="Nombre">{{ $actividad->nombre }}</td>
                                <td data-label="Imagen"><img class="imagen"
                                        src="{{ URL::to('/') . '/actividades/' . $actividad->id . '/' . $actividad->imagen }}">
                                </td>
                                <td data-label="Acciones">
                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                        <div class="btn-group me-2 mb-2" role="group">
                                            <form action="{{ url('actividad/' . $actividad->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                    title="Ver">
                                                    <i class="material-icons">visibility</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2 mb-2" role="group">
                                            <form
                                                action="{{ route('editar-actividad', ['idMundo' => $mundo->id, 'idNivel' => $nivel->id, 'idLectura' => $lectura->id, 'idActividad' => $actividad->id]) }}"
                                                method="GET">
                                                @csrf
                                                @method('UPDATE')
                                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                                    title="Editar">
                                                    <i class="material-icons">border_color</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2 mb-2" role="group">
                                            <form
                                                action="{{ route('eliminar-actividad', ['idMundo' => $mundo->id, 'idNivel' => $nivel->id, 'idLectura' => $lectura->id, 'idActividad' => $actividad->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Está seguro de que desea eliminar la actividad?')">
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

            @if (session('success'))
                <div id="ocultar2" class="notificacion">
                    <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div id="ocultar2" class="notificacion">
                    <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <button id="btn-float" class="btn btn-primary btn-float" data-toggle="tooltip" title="Subir actividad">
                <span class="icon">
                    <i class="material-icons">add</i>
                </span>
            </button>

            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">
                        <i class="material-icons">cancel</i>
                    </span>
                    <h4 class="card-title">Actividad</h4>
                    <form method="POST"
                        action="{{ route('registrar-actividad', ['idMundo' => $mundo->id, 'idNivel' => $nivel->id, 'idLectura' => $lectura->id]) }}"
                        class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lectura_id" value="{{ $lectura->id }}">
                        <div class="form-group row">
                            <label class="label-file">{{ __('Nombre de la actividad') }}</label>
                            <input type="text" name="nombre" class="form-control" id="file-name-input" required>
                            <div class="invalid-feedback">Ingresa un nombre válido</div>
                        </div>
                        <div class="form-group row">
                            <label class="label-file">{{ __('Tamaño de imagen: 500 x 333 píxeles') }}</label>
                            <label for="image-upload-input" class="file-upload">
                                <p>Selecciona la imagen</p>
                                <span class="image-upload-name"></span>
                            </label>
                            <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .svg .webp"
                                id="image-upload-input" class="file-upload-input" required>
                            <div class="invalid-feedback">Selecciona una imagen</div>
                        </div>

                        <div class="form-group row">
                            <label class="label-file">{{ __('Archivo comprimido en zip') }}</label>
                            <label for="file-upload-input" class="file-upload">
                                <p>Selecciona el archivo</p>
                                <span class="file-upload-name"></span>
                            </label>
                            <input type="file" name="archivo" accept=".zip" id="file-upload-input"
                                class="file-upload-input" required>
                            <div class="invalid-feedback">Selecciona un archivo</div>
                        </div>
                        <div class="btn-upload">
                            <button id="subir" class="boton btn btn-warning " type="submit">
                                Guardar actividad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/botonflotante.js') }}"></script>
    <script src="{{ asset('js/subiractividad.js') }}"></script>
    <x-foot />
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        var alertElement = document.querySelector('.alert');
        if (alertElement) {
            setTimeout(function() {
                alertElement.classList.add('d-none');
            }, 4000);
        }
    </script>
</body>

</html>
