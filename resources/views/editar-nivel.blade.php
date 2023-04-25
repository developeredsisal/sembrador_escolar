<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Nivel</title>
</head>

<body>
    <x-navbar />
    <section class="contenedor">
        <x-appbar />

        <div class="contenido">
            <h2>Editar el nivel: {{ $nivel->nombre }}</h2>
            <div class="card-body">
                <form
                    action="{{ route('actualizar-nivel', ['id_mundo' => $mundo->id, 'id_nivel' => $nivel->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 col-12 py-2">
                            <img src="{{ URL::to('/') . '/niveles/' . $nivel->id . '/' . $nivel->imagen }}"
                                class="img-thumbnail" alt="Imagen actual">
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">{{ __('Nombre') }}</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    value="{{ $nivel->nombre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen" class="col-form-label">{{ __('Imagen') }}</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                                <small class="form-text text-muted">Selecciona una nueva imagen para actualizar la
                                    imagen actual, el tamaño recomendado es de 500 x 388 píxeles, si deseas cambiar el
                                    archivo de la actividad te recomendamos eliminar y subir de nuevo la
                                    actividad.</small>
                            </div>
                            <div class="py-3">
                                <a class="a" href="{{ route('subir-nivel', ['idMundo' => $mundo->id]) }}">
                                    <button type="button" class="btn btn-secondary btn-md">Cancelar</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <x-foot />
</body>

</html>
