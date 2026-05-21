@extends('layouts.admin', ['hideSidebar' => true])

@section('titulo_pagina', 'Historial Médico')

@push('styles')
<style>
    /* Premium Aesthetic Custom CSS */
    .hero-pet-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        color: white;
        box-shadow: 0 15px 35px rgba(118, 75, 162, 0.2);
        position: relative;
        overflow: hidden;
    }
    
    .hero-pet-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        animation: rotateBg 20s linear infinite;
    }

    @keyframes rotateBg {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .glass-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding: 20px 0;
        margin: 20px 0;
    }
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 40px;
        height: 100%;
        width: 4px;
        background: #e2e8f0;
        border-radius: 2px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 40px;
        padding-left: 100px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s forwards ease-out;
    }
    
    /* Stagger animations for timeline items */
    @for ($i = 1; $i <= 10; $i++)
        .timeline-item:nth-child({{ $i }}) {
            animation-delay: {{ $i * 0.1 }}s;
        }
    @endfor

    .timeline-icon {
        position: absolute;
        left: 24px;
        top: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #4e73df;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 0 8px #f8f9fc, 0 4px 10px rgba(78, 115, 223, 0.4);
        z-index: 1;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .timeline-item:hover .timeline-icon {
        transform: scale(1.2);
        background: #2e59d9;
    }

    .timeline-content {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .timeline-content::before {
        content: '';
        position: absolute;
        left: -10px;
        top: 15px;
        border-style: solid;
        border-width: 10px 10px 10px 0;
        border-color: transparent white transparent transparent;
    }

    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: rgba(78, 115, 223, 0.2);
    }

    .stat-box {
        background: #f8f9fc;
        padding: 10px 15px;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #e3e6f0;
    }
    
    .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #858796;
        letter-spacing: 1px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #3a3b45;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('contenido')
    <!-- Botón Volver -->
    <div class="mb-4">
        <a href="{{ route('admin.expedientes') }}" class="btn btn-light shadow-sm text-primary font-weight-bold btn-sm px-3 rounded-pill">
            <i class="fas fa-arrow-left mr-1"></i> Volver al Buscador
        </a>
    </div>

    <!-- Hero Card de Mascota -->
    <div class="hero-pet-card p-4 p-md-5 mb-5">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-auto">
                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-lg" style="width: 100px; height: 100px;">
                    <i class="fas fa-paw fa-3x text-primary"></i>
                </div>
            </div>
            <div class="col mt-4 mt-md-0">
                <h1 class="display-4 font-weight-bold mb-2">{{ $mascota->nombre }}</h1>
                <div class="d-flex flex-wrap gap-2" style="gap: 10px;">
                    <span class="glass-badge"><i class="fas fa-hashtag mr-1"></i> Folio: {{ $mascota->id }}</span>
                    <span class="glass-badge"><i class="fas fa-dog mr-1"></i> {{ $mascota->especie }} / {{ $mascota->raza }}</span>
                    <span class="glass-badge"><i class="fas fa-user mr-1"></i> Dueño: {{ $mascota->dueno->nombre_completo ?? 'No asignado' }}</span>
                </div>
            </div>
            <div class="col-md-auto mt-4 mt-md-0 text-md-right">
                <div class="text-white-50 small font-weight-bold text-uppercase tracking-wide mb-1">Total Consultas</div>
                <div class="display-4 font-weight-bold">{{ $mascota->consultas->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Título de Sección -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-stethoscope text-primary mr-2"></i> Historial Clínico
        </h2>
    </div>

    <!-- Timeline de Consultas -->
    @if($mascota->consultas->isEmpty())
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body text-center p-5">
                <div class="display-1 text-gray-300 mb-3"><i class="fas fa-box-open"></i></div>
                <h4 class="text-gray-600 font-weight-bold">No hay consultas registradas</h4>
                <p class="text-gray-500 mb-0">Esta mascota aún no tiene historial médico en el sistema.</p>
            </div>
        </div>
    @else
        <div class="timeline">
            @foreach($mascota->consultas as $consulta)
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <div class="timeline-content">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <h4 class="text-primary font-weight-bold mb-2 mb-md-0">
                            {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d de F, Y') }}
                        </h4>
                        <span class="badge badge-primary badge-pill px-3 py-2 shadow-sm">
                            <i class="fas fa-user-md mr-1"></i> Dr. {{ $consulta->veterinario->nombre_completo ?? 'No especificado' }}
                        </span>
                    </div>

                    <!-- Datos Físicos -->
                    <div class="row mb-4">
                        <div class="col-sm-6 col-md-3 mb-2 mb-md-0">
                            <div class="stat-box">
                                <div class="stat-label">Peso</div>
                                <div class="stat-value">{{ $consulta->peso ?? '--' }} <small>kg</small></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-box">
                                <div class="stat-label">Talla</div>
                                <div class="stat-value">{{ $consulta->talla ?? '--' }} <small>cm</small></div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnóstico y Tratamiento -->
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h6 class="font-weight-bold text-gray-800 text-uppercase text-xs"><i class="fas fa-search-plus text-info mr-1"></i> Diagnóstico</h6>
                            <div class="p-3 bg-light rounded text-gray-700 h-100" style="border-left: 4px solid #36b9cc;">
                                {{ $consulta->diagnostico ?? 'Sin diagnóstico registrado.' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-gray-800 text-uppercase text-xs"><i class="fas fa-pills text-success mr-1"></i> Tratamiento</h6>
                            <div class="p-3 bg-light rounded text-gray-700 h-100" style="border-left: 4px solid #1cc88a;">
                                {!! nl2br(e($consulta->tratamiento ?? 'Sin tratamiento registrado.')) !!}
                        </div>
                    </div>

                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.expedientes.consultas.show', [$mascota->id, $consulta->id]) }}" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm font-weight-bold">
                            <i class="fas fa-eye mr-1"></i> Ver Detalles y Antecedentes
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection
