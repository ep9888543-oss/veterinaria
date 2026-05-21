@extends('layouts.main', ['hideSidebar' => true])

@section('titulo_pagina', 'Gestión de Expedientes')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-file-medical mr-2 text-dark"></i> Expedientes Médicos
        </h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vista de Expedientes</h6>
        </div>
        <div class="card-body py-5">
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 position-relative">
                    <div class="input-group input-group-lg shadow-sm">
                        <input type="text" id="buscador-expedientes" class="form-control border-left-primary" placeholder="Ingrese nombre del paciente, dueño o código de expediente..." aria-label="Buscar" autocomplete="off">
                    </div>
                    <!-- Dropdown de sugerencias -->
                    <div id="sugerencias-container" class="dropdown-menu w-100 shadow mt-1" style="display: none; position: absolute; z-index: 1000; top: 100%;">
                        <!-- Los resultados de JS se inyectarán aquí -->
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 text-center">
                    <button id="btn-ver-consultas" class="btn btn-info btn-icon-split btn-lg mx-2 shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-notes-medical"></i>
                        </span>
                        <span class="text">Ver Consultas</span>
                    </button>
                    
                    <button class="btn btn-success btn-icon-split btn-lg mx-2 shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nuevo Paciente / Mascota</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputBuscador = document.getElementById('buscador-expedientes');
        const sugerenciasContainer = document.getElementById('sugerencias-container');
        let timeout = null;
        let selectedMascotaId = null;

        document.getElementById('btn-ver-consultas').addEventListener('click', function() {
            if (selectedMascotaId) {
                window.location.href = `/expedientes/${selectedMascotaId}/consultas`;
            } else {
                alert('Por favor, busque y seleccione una mascota primero.');
            }
        });

        inputBuscador.addEventListener('input', function (e) {
            clearTimeout(timeout);
            const query = e.target.value;
            selectedMascotaId = null; // Reset on new input

            if (query.length < 2) {
                sugerenciasContainer.style.display = 'none';
                return;
            }

            timeout = setTimeout(() => {
                fetch(`{{ route('veterinario.expedientes.buscar') }}?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        sugerenciasContainer.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const a = document.createElement('a');
                                a.className = 'dropdown-item py-2 border-bottom';
                                a.href = 'javascript:void(0)';
                                a.innerHTML = `
                                    <span class="text-gray-800 font-weight-bold">
                                        🐶 [Folio: ${item.id}] ${item.nombre} - Dueño: ${item.dueno_nombre}
                                    </span>
                                `;
                                a.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    selectedMascotaId = item.id;
                                    inputBuscador.value = `[Folio: ${item.id}] ${item.nombre}`;
                                    sugerenciasContainer.style.display = 'none';
                                });
                                sugerenciasContainer.appendChild(a);
                            });
                        } else {
                            sugerenciasContainer.innerHTML = '<div class="dropdown-item text-muted disabled py-2">No se encontraron resultados</div>';
                        }
                        sugerenciasContainer.style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!inputBuscador.contains(e.target) && !sugerenciasContainer.contains(e.target)) {
                sugerenciasContainer.style.display = 'none';
            }
        });
    });
</script>
@endpush
