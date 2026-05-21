@extends('layouts.admin', ['hideSidebar' => true])

@section('titulo_pagina', 'Eliminar Usuario')

@section('contenido')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-times mr-2 text-dark"></i> Eliminar Usuario
        </h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al listado
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-danger">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Confirmación de Eliminación</h6>
                </div>
                <div class="card-body">
                    
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                        
                        @if($hasDependencies)
                            <h4 class="text-gray-900 font-weight-bold">No se puede eliminar a {{ $user->name }}</h4>
                            <p class="text-danger mt-3">
                                Este usuario tiene registros de consultas (o dependencias) asociados en el sistema. 
                                Eliminarlo corrompería la integridad de los datos médicos.
                            </p>
                        @else
                            <h4 class="text-gray-900 font-weight-bold">¿Estás seguro de eliminar a {{ $user->name }}?</h4>
                            <p class="text-muted mt-3">
                                Esta acción eliminará permanentemente al usuario del sistema. 
                                <strong>Esta acción no se puede deshacer.</strong>
                            </p>
                        @endif
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Nombre:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rol:</th>
                                    <td><span class="badge badge-info">{{ ucfirst($user->rol) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                        
                        @if(!$hasDependencies)
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash mr-1"></i> Confirmar Eliminación
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
