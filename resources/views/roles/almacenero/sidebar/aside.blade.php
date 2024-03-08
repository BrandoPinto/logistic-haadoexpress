<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
        <img src="{{ asset('img/logohaado.png') }}"
            class="navbar-brand-img h-200" alt="main_logo">
        <span class="ms-1 font-weight-bold">HAADO EXPRESS</span>
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item mt-3 d-flex align-items-center">
            <div class="ps-4">
                <i class="fas fa-truck" style="color: #f4645f;"></i>
            </div>
            <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Pedidos</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'show.orders.today' ? 'active' : '' }} {{ auth()->user()->hasRole('Cliente2')? 'disabled': '' }}"
                href="{{ route('show.orders.today') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-calendar-alt text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Pedidos de hoy</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'orders.admin' ? 'active' : '' }}"
                href="{{ route('orders.admin') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-clipboard-list text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Historial general</span>
            </a>
        </li>
        <li class="nav-item mt-3 d-flex align-items-center">
            <div class="ps-4">
                <i class="fas fa-truck" style="color: #f4645f;"></i>
            </div>
            <h6 class="ms-2 text-boxes text-xs font-weight-bolder opacity-6 mb-0">Articulos</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'articulos.general' ? 'active' : '' }}"
                href="{{ route('articulos.general') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-clipboard-list text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Listado general</span>
            </a>
        </li>
        <li class="nav-item mt-3 d-flex align-items-center">
            <div class="ps-4">
                <i class="fas fa-truck-loading" style="color: #f4645f;"></i>
            </div>
            <h6 class="ms-2 text-boxes text-xs font-weight-bolder opacity-6 mb-0">Reabastecimiento</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'resupply.admin' ? 'active' : '' }}"
                href="{{ route('resupply.admin') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-clipboard-list text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Listado general</span>
            </a>
        </li>
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Otras páginas</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'show.delivery' ? 'active' : '' }}"
                href="{{ route('show.delivery') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni fas fa-motorcycle text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Listado de deliveries</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                href="{{ route('profile') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Perfil</span>
            </a>
        </li>
        <hr class="horizontal dark">
        <li class="nav-item">
            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form-sidenav">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-sidenav').submit();"
                    class="nav-link">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Log out</span>
                </a>
            </form>
        </li>
    </ul>
</div>
