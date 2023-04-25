<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Niveles</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        <div class="contenido">
            <div class="pb-3">
                <a href="{{ route('mundo') }}">
                    <button class="atras">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                        </svg>
                        <span>Mundos</span>
                    </button>
                </a>
            </div>
            <h2>Niveles del mundo: "{{ $mundo->nombre }}"</h2>
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
                        @foreach ($niveles as $nivel)
                            <tr>
                                <td class="text-center">{{ $c++ }}</td>
                                <td data-label="Nombre">{{ $nivel->nombre }}</td>
                                <td data-label="Imagen"><img class="imagen"
                                        src="{{ URL::to('/') . '/niveles/' . $nivel->id . '/' . $nivel->imagen }}"></td>
                                <td data-label="Acciones">
                                    <div class="d-flex flex-column flex-sm-row align-items-center">
                                        <div class="btn-group me-2" role="group">
                                            <form action="{{ route('editar-nivel', ['mundo_id' => $nivel->mundo_id, 'nivel_id' => $nivel->id]) }}" method="GET">
                                                @csrf
                                                @method('UPDATE')
                                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                                    title="Editar">
                                                    <i class="material-icons">border_color</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2 my-2" role="group">
                                            <form action="" method="GET">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info" data-toggle="tooltip"
                                                    title="Lecturas">
                                                    <i class="material-icons">bookmark_add</i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-group me-2" role="group">
                                            <form action="{{ route('eliminar-nivel', ['id' => $nivel->id]) }}" method="POST"
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

            <button id="btn-float" class="btn btn-primary btn-float" data-toggle="tooltip" title="Subir niveles">
                <span class="icon">
                    <i class="material-icons">add</i>
                </span>
            </button>

            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">
                        <i class="material-icons">cancel</i>
                    </span>
                    <h4 class="card-title">Subir nivel</h4>
                    <form method="POST" action="/mundo/{{ $mundo->id }}/nivel/registrar" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mundo_id" value="{{ $mundo->id }}">
                        <div class="form-group row">
                            <label class="label-file">{{ __('Nombre del nivel') }}</label>
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

                        <div class="btn-upload">
                            <button id="subir" class="boton btn btn-warning " type="submit">
                                Guardar nivel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/botonflotante.js') }}"></script>
    <script src="{{ asset('js/subirnivel.js') }}"></script>
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
