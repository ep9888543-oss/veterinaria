{{-- ============================================================
     TOPBAR - Veterinaria
     Partial incluido desde layouts/main.blade.php
     ============================================================ --}}

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    {{-- Sidebar Toggle (visible en móvil) --}}
    @if(!isset($hideSidebar) || !$hideSidebar)
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    @endif

    {{-- Separador --}}
    <div class="topbar-divider d-none d-sm-block ml-auto"></div>

    {{-- Navbar derecha --}}
    <ul class="navbar-nav ml-2">

        {{-- Enlace a Expedientes --}}
        <li class="nav-item mx-1 {{ request()->routeIs('veterinario.expedientes') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('veterinario.expedientes') }}">
                <i class="fas fa-folder-open fa-fw mr-1"></i>
                <span class="d-none d-sm-inline font-weight-bold text-gray-600">Expedientes</span>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- Usuario autenticado --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::user()->name }}
                </span>
                <i class="fas fa-user-circle fa-2x text-gray-400"></i>
            </a>
            {{-- Dropdown - Información del usuario --}}
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>
            </div>
        </li>

    </ul>

</nav>
