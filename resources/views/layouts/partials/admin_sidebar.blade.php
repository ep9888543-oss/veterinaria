{{-- ============================================================
     SIDEBAR - Administrador
     Partial incluido desde layouts/admin.blade.php
     ============================================================ --}}

<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- Sidebar Brand --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Vet</div>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Heading --}}
    <div class="sidebar-heading">
        Consulta Actual
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ request()->route('mascota') && request()->route('consulta') ? route('admin.expedientes.consultas.diagnostico', [request()->route('mascota'), request()->route('consulta')]) : '#' }}">
            <i class="fas fa-fw fa-search-plus"></i>
            <span>Diagnóstico de la consulta</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#tratamiento">
            <i class="fas fa-fw fa-pills"></i>
            <span>Tratamiento de la consulta</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">

    {{-- Heading --}}
    <div class="sidebar-heading">
        Historial Clínico
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#alergias">
            <i class="fas fa-fw fa-allergies text-danger"></i>
            <span>Antecedentes Alergias</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#lesiones">
            <i class="fas fa-fw fa-band-aid text-info"></i>
            <span>Antecedentes Lesiones</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#patologicos">
            <i class="fas fa-fw fa-virus text-warning"></i>
            <span>Antecedentes Patológicos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#alimentacion">
            <i class="fas fa-fw fa-bone text-success"></i>
            <span>Historial Alimentación</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider d-none d-md-block">

    {{-- Sidebar Toggler --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
