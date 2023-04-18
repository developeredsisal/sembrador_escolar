<nav class="appbar">
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <div class="logo-appbar ocultar">
            <img src="{{ asset('images/pse-logo.svg') }}" alt="Logo Sembrador Escolar">
        </div>
    </div>
    <div class="logo-appbar ocultar2">
        <img src="{{ asset('images/pse-logo.svg') }}" alt="Logo Sembrador Escolar">
    </div>
    <div class="search-box ocultar">
        <input type="text" placeholder="Buscar...">
        <i class='bx bx-search'></i>
    </div>
    <div class="dropdown ocultar2">
        <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('cerrar-sesion') }}">Cerrar sesión</a></li>
        </ul>
    </div>

    <div class="dropdown ocultar">
        <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('cerrar-sesion') }}">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>
