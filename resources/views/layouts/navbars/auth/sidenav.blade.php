<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    @php
        $role = auth()->user()->id_rol;
    @endphp
    @if ($role == 1)
        @include('roles.admin.sidebar.aside')
    @elseif ($role == 2)
        @include('roles.almacenero.sidebar.aside')
    @elseif ($role == 3)
        @include('roles.delivery.sidebar.aside')
    @elseif ($role == 4)
        @include('roles.cliente1.sidebar.aside')
    @endif
</aside>
