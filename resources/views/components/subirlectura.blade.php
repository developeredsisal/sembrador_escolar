<form method="POST" action="{{ route('registrar-lectura') }}" class="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label class="label-file">{{ __('Nombre de la lectura') }}</label>
        <input type="text" name="nombre" class="form-control" id="file-name-input" required autofocus>
    </div>
    <div class="form-group row">
        <small class="form-text text-muted">Tamaño de imagen: 500 x 333 píxeles</small>
        <label for="image-upload-input" class="file-upload">
            <p>Selecciona la imagen</p>
            <span class="image-upload-name"></span>
        </label>
        <input type="file" name="imagen" accept=".jpg, .jpeg, .png, .svg .webp" id="image-upload-input"
            class="file-upload-input" required>
    </div>
    <div class="form-group row">
        <select id="category-select" name="grado" class="form-select" required>
            <option value="">Selecciona el grado</option>
            <option value="1">Primero</option>
            <option value="2">Segundo</option>
            <option value="3">Tercero</option>
            <option value="4">Cuarto</option>
            <option value="5">Quinto</option>
            <option value="6">Sexto</option>
        </select>
    </div>

    <div class="btn-upload">
        <button id="subir" class="boton btn btn-primary" type="submit">Guardar lectura</button>
    </div>
</form>

<script src="{{ asset('js/subirlectura.js') }}"></script>
