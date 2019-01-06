<li class="nav-item">
    <a class="nav-link" href="#0">
        <i class="material-icons">D</i>
        <p>Dashboard </p>
    </a>
</li>

<li class="nav-item {{ (\Request::is('admin/users/*') or \Request::is('admin/users'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/admin/users')}}">
        <i class="material-icons">П</i>
        <p>Пользователи</p>
    </a>
</li>

<li class="nav-item {{ (\Request::is('admin/roles/*') or \Request::is('admin/roles') ) ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/admin/roles')}}">
        <i class="material-icons">Roles</i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item {{ (\Request::is('admin/permissions/*') or \Request::is('admin/permissions') ) ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/admin/permissions')}}">
        <i class="material-icons">Permissions</i>
        <p>permissions</p>
    </a>
</li>
<li class="nav-item {{ (\Request::is('admin/crud/*') or \Request::is('admin/crud') ) ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/admin/crud')}}">
        <i class="material-icons">Generator</i>
        <p>Generator</p>
    </a>
</li>

