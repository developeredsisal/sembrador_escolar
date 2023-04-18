<li>
    <a href="{{ route('inicio') }}" class="{{ Request::is('inicio') ? 'active' : '' }}">
        <i class='bx bx-home'></i>
        <span class="links_name">Inicio</span>
    </a>
</li>
@role('admin')
    <li>
        <a href="{{ route('lectura') }}" class="{{ Request::is('lectura') ? 'active' : '' }}">
            <i class='bx bx-book'></i>
            <span class="links_name">Lecturas</span>
        </a>
    </li>
    <li>
        <a href="{{ route('usuario') }}" class="{{ Request::is('usuario') ? 'active' : '' }}">
            <i class='bx bx-user-circle'></i>
            <span class="links_name">Usuarios</span>
        </a>
    </li>
@endrole
