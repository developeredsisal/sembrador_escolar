<nav>
    <li>
        <a href="{{ route('inicio') }}" class="{{ Request::is('inicio') ? 'active' : '' }}">
            <i class='bx bx-home'></i>
            <span class="links_name ocultar">Inicio</span>
        </a>
    </li>
    @role('admin')
        <li>
            <a href="{{ route('mundo') }}" class="{{ Request::is('mundo') ? 'active' : '' }}">
                <i class='bx bx-book'></i>
                <span class="links_name ocultar">Recursos</span>
            </a>
        </li>
        <li>
            <a href="{{ route('usuario') }}" class="{{ Request::is('usuario') ? 'active' : '' }}">
                <i class='bx bx-user-circle'></i>
                <span class="links_name ocultar">Usuarios</span>
            </a>
        </li>
    @endrole
</nav>
