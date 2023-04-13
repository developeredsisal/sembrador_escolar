<li>
    <a href="{{ route('inicio') }}" class="{{ Request::is('inicio') ? 'active' : '' }}">
        <i class='bx bx-home'></i>
        <span class="links_name">Inicio</span>
    </a>
</li>
<li>
    <a href="{{ route('lecturas') }}" class="{{ Request::is('lecturas') ? 'active' : '' }}">
        <i class='bx bx-book'></i>
        <span class="links_name">Lecturas</span>
    </a>
</li>
@role('admin')
    <li>
        <a href="{{ route('usuarios') }}" class="{{ Request::is('usuarios') ? 'active' : '' }}">
            <i class='bx bx-user-circle'></i>
            <span class="links_name">Usuarios</span>
        </a>
    </li>
@endrole
