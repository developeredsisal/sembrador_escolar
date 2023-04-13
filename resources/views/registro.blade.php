<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <title>Sembrador Escolar - Registro</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>

<body>
    <div class="registro">
        <div class="registro-form">
            <form method="POST" action="{{ route('validar-registro') }}">
                @csrf
                <h2>Formulario de registro</h2>
                <div class="form-group">
                    <label for="userInput">Nombre del alumno</label>
                    <input class="form-control" placeholder="Nombres y apellidos" type="text" name="name"
                        id="userInput" autocomplete="disable" required autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico (Encargado)</label>
                    <input name="email" class="@error('email') is-invalid @enderror form-control" type="email"
                        id="email" required autocomplete="disable" placeholder="nombre@correo.com"
                        value="{{ old('email') }}" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="grado">Grado</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="" disabled selected>Seleccione el grado</option>
                        <option value="1">Primer grado</option>
                        <option value="2">Segundo grado</option>
                        <option value="3">Tercer grado</option>
                        <option value="4">Cuarto grado</option>
                        <option value="5">Quinto grado</option>
                        <option value="6">Sexto grado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="passwordInput">Contraseña</label>
                    <input class="form-control" placeholder="Escribe tu contraseña" type="password" name="password"
                        id="passwordInput" autocomplete="disable" required>
                    <span class="invalid-feedback" role="alert">
                        <strong id="password-message"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" placeholder="Repite tu contraseña" name="password_confirmation"
                        id="password_confirmation passwordInput"
                        class="@error('password_confirmation') is-invalid @enderror form-control" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-button">
                    <button type="submit" class="btn-register">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const passwordInput = document.querySelector("#passwordInput");
        const passwordMessage = document.querySelector("#password-message");

        passwordInput.addEventListener("input", function() {
            if (passwordInput.value.length < 6) {
                passwordMessage.textContent =
                    "6 caracteres como mínimo";
            } else {
                passwordMessage.textContent = "";
            }
        });
    </script>
</body>

</html>
