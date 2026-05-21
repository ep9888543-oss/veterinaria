@extends('layouts.admin')

@section('titulo_pagina', 'Diagnóstico de la Consulta')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .empty-state {
        padding: 60px 20px;
        text-align: center;
        background: #f8f9fc;
        border: 2px dashed #d1d3e2;
        border-radius: 15px;
    }
    .empty-state-icon {
        font-size: 4rem;
        color: #dddfeb;
        margin-bottom: 20px;
    }
    .diagnosis-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #3a3b45;
        background: #f8f9fc;
        padding: 30px;
        border-radius: 10px;
        border-left: 5px solid #4e73df;
    }
</style>
@endpush

@section('contenido')
    <!-- Botón Volver -->
    <div class="mb-4">
        <a href="{{ route('admin.expedientes.consultas.show', [$consulta->mascota->id, $consulta->id]) }}" class="btn btn-light shadow-sm text-primary font-weight-bold btn-sm px-3 rounded-pill">
            <i class="fas fa-arrow-left mr-1"></i> Volver a Detalles
        </a>
    </div>

    <!-- Encabezado -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-search-plus text-primary mr-2"></i> Diagnóstico Médico
        </h1>
        <div class="mt-3 mt-sm-0">
            <h6 class="text-muted mb-0">Paciente: <strong class="text-dark">{{ $consulta->mascota->nombre }}</strong></h6>
            <small class="text-muted">Consulta del {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y') }}</small>
        </div>
    </div>

    <!-- Contenido del Diagnóstico -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="glass-card p-4 p-md-5">
                
                @if(!empty($consulta->diagnostico))
                    <!-- Estado con Diagnóstico Existente -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-weight-bold text-gray-800 mb-0">Evaluación Clínica</h4>
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3 font-weight-bold shadow-sm">
                            <i class="fas fa-edit mr-1"></i> Editar
                        </button>
                    </div>
                    
                    <div class="diagnosis-content shadow-sm">
                        {!! nl2br(e($consulta->diagnostico)) !!}
                    </div>
                @else
                    <!-- Estado Vacío -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-file-medical-alt"></i>
                        </div>
                        <h3 class="text-gray-600 font-weight-bold mb-3">Aún sin diagnóstico</h3>
                        <p class="text-muted mb-4">No se ha registrado una evaluación clínica para esta consulta.</p>
                        <button class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold shadow">
                            <i class="fas fa-plus mr-1"></i> Crear Diagnóstico
                        </button>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection
