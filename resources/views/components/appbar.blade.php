<nav>
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <div class="logo-appbar">
            <img src="{{ asset('images/pse-logo.svg') }}" alt="">
        </div>
    </div>
    <div class="search-box">
        <input type="text" placeholder="Buscar...">
        <i class='bx bx-search'></i>
    </div>

    <div class="dropdown">
        <button class="btn btn-light btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('cerrar-sesion') }}">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>
