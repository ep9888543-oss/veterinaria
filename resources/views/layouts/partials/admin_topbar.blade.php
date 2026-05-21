{{-- ============================================================
     TOPBAR - Administrador
     Partial incluido desde layouts/admin.blade.php
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

        {{-- Enlace a Expedientes (Admin) --}}
        <li class="nav-item mx-1 {{ request()->routeIs('admin.expedientes') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.expedientes') }}">
                <i class="fas fa-folder-open fa-fw mr-1"></i>
                <span class="d-none d-sm-inline font-weight-bold text-gray-600">Expedientes</span>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- Alertas Administrativas (Notificaciones) --}}
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-gray-600"></i>
                <span class="badge badge-danger badge-counter">2</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-dark border-dark">Alertas del Sistema</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Hoy</div>
                        Backup diario completado con advertencias.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todas las alertas</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- Usuario autenticado --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">
                    Administrador: {{ Auth::user()->name }}
                </span>
                <i class="fas fa-user-shield fa-2x text-dark"></i>
            </a>
            {{-- Dropdown - Información del usuario --}}
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Mi Perfil Admin
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
