<!DOCTYPE html>
<html lang="es">

<head>
    <x-head />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Sembrador Escolar - Inicio de sesión</title>
</head>

<body>
    <div class="login">
        <div class="login-form">
            <img src="{{ asset('images/login-logo.svg') }}" alt="Logo de Sembrador Escolar" class="form-logo">
            <form method="POST" action="{{ route('inicia-sesion') }}">
                @csrf
                <h2>Inicia sesión para continuar</h2>
                <div class="form-group row">
                    <label for="email">{{ __('Correo electrónico') }}</label>

                    <div class="input-container">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="nombre@correo.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password">{{ __('Contraseña') }}</label>

                    <div class="input-container">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Escribe tu contraseña">
                        <img id="eye-icon" src="{{ asset('images/cerrado.svg') }}"
                            onclick="togglePasswordVisibility()" />
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit"><strong>Ingresar</strong></button>
                <div class="res-password">
                    <a href="" class="res-password">¿Olvidaste la
                        contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "{{ asset('images/abierto.svg') }}";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "{{ asset('images/cerrado.svg') }}";
            }
        }
    </script>
</body>

</html>
