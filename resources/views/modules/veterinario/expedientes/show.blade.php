@extends('layouts.main')

@section('titulo_pagina', 'Detalle de Consulta')

@push('styles')
<style>
    body {
        background-color: #f4f6f9;
    }
    .custom-card {
        background: #ffffff;
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.03);
        margin-bottom: 20px;
    }
    .breadcrumb-card {
        padding: 12px 20px;
        color: #4e73df;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .breadcrumb-card span.text-muted {
        color: #858796 !important;
        margin: 0 5px;
    }
    .patient-header-card {
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-left: 4px solid #4e73df;
    }
    .paw-icon {
        font-size: 2.5rem;
        color: #4e73df;
        background: #eaecf4;
        padding: 15px;
        border-radius: 50%;
        margin-right: 20px;
    }
    .patient-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #3a3b45;
        margin-bottom: 2px;
    }
    .patient-subtitle {
        font-size: 0.85rem;
        color: #858796;
    }
    .owner-info {
        text-align: right;
    }
    .owner-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #858796;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    .owner-name {
        font-size: 1rem;
        font-weight: 600;
        color: #3a3b45;
    }
    .owner-phone {
        font-size: 0.85rem;
        color: #858796;
    }
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .section-title.green {
        color: #1cc88a;
    }
    .consultation-badge {
        background-color: #4e73df;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .metric-box {
        border: 1px solid #eaecf4;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .metric-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #858796;
        letter-spacing: 0.05em;
        margin-bottom: 10px;
    }
    .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3a3b45;
    }
    .metric-unit {
        font-size: 0.9rem;
        font-weight: 500;
    }
    .metric-icon {
        font-size: 1.2rem;
        color: #36b9cc;
        margin-bottom: 5px;
    }
    .data-row {
        margin-bottom: 15px;
    }
    .data-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #858796;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    .data-value {
        font-size: 0.95rem;
        color: #3a3b45;
        font-weight: 500;
    }
    .badge-yes {
        background-color: #1cc88a;
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .badge-no {
        background-color: #e74a3b;
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>
@endpush

@section('contenido')
    <h3 class="text-gray-800 mb-4" style="font-weight: 400;">Detalle de Consulta</h3>

    <!-- Breadcrumb -->
    <div class="custom-card breadcrumb-card">
        <a href="{{ route('veterinario.expedientes.consultas', $consulta->mascota->id) }}">Expedientes</a> 
        <span class="text-muted">/</span> 
        {{ $consulta->mascota->nombre }} 
        <span class="text-muted">/</span> 
        Consulta #{{ $consulta->id }}
    </div>

    <!-- Header Tarjeta Mascota y Dueño -->
    <div class="custom-card patient-header-card">
        <div class="d-flex align-items-center">
            <div class="paw-icon">
                <i class="fas fa-paw"></i>
            </div>
            <div>
                <div class="patient-title">{{ $consulta->mascota->nombre }}</div>
                <div class="patient-subtitle">
                    Folio #{{ $consulta->mascota->id }} • {{ $consulta->mascota->especie }} / {{ $consulta->mascota->raza ?? 'Mestizo' }} • Tipo de sangre: {{ $consulta->mascota->tipo_sangre ?? 'Desconocido' }}
                </div>
            </div>
        </div>
        <div class="owner-info">
            <div class="owner-label">Dueño</div>
            <div class="owner-name">
                <i class="fas fa-user text-gray-500 mr-1"></i> {{ $consulta->mascota->dueno->nombre_completo ?? 'Sin dueño' }}
            </div>
            <div class="owner-phone">
                <i class="fas fa-phone-alt text-gray-500 mr-1" style="font-size: 0.8em;"></i> {{ $consulta->mascota->dueno->telefono ?? 'Sin teléfono' }}
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Columna Izquierda: Consulta -->
        <div class="col-lg-8">
            <div class="custom-card p-4 h-100">
                <div class="section-title">
                    <div>
                        <i class="fas fa-stethoscope mr-2"></i> Consulta #{{ $consulta->id }}
                    </div>
                    <div class="consultation-badge">
                        {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Veterinario -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="metric-box">
                            <div class="metric-label">Veterinario</div>
                            <div class="metric-icon"><i class="fas fa-user-md"></i></div>
                            <div class="metric-value" style="font-size: 1.1rem; color: #4e73df;">
                                {{ $consulta->veterinario->nombre_completo ?? '—' }}
                            </div>
                        </div>
                    </div>
                    <!-- Peso -->
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="metric-box">
                            <div class="metric-label">Peso</div>
                            <div class="metric-value">
                                {{ $consulta->peso ? number_format($consulta->peso, 2) : '—' }} <span class="metric-unit text-muted">kg</span>
                            </div>
                        </div>
                    </div>
                    <!-- Talla -->
                    <div class="col-md-4">
                        <div class="metric-box">
                            <div class="metric-label">Talla</div>
                            <div class="metric-value">
                                {{ $consulta->talla ? number_format($consulta->talla, 2) : '—' }} <span class="metric-unit text-muted">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Datos del Paciente -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="custom-card p-4 h-100">
                <div class="section-title green mb-4" style="justify-content: flex-start;">
                    <i class="fas fa-info-circle mr-2"></i> Datos del Paciente
                </div>

                <div class="data-row">
                    <div class="data-label">Fecha de Nacimiento</div>
                    <div class="data-value">
                        {{ $consulta->mascota->fecha_nacimiento ? \Carbon\Carbon::parse($consulta->mascota->fecha_nacimiento)->format('d/m/Y') : 'Desconocida' }}
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-label">Tipo de Sangre</div>
                    <div class="data-value">
                        {{ $consulta->mascota->tipo_sangre ?? 'Desconocido' }}
                    </div>
                </div>

                <div class="data-row">
                    <div class="data-label">Comportamiento</div>
                    <div class="data-value">
                        {{ $consulta->mascota->comportamiento ?? 'No especificado' }}
                    </div>
                </div>

                <div class="data-row mt-4">
                    <div class="data-label mb-2">Adoptado</div>
                    <div>
                        @if($consulta->mascota->es_adoptado)
                            <span class="badge-yes">Sí</span>
                        @else
                            <span class="badge-no">No</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
