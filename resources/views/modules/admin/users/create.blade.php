@extends('layouts.admin', ['hideSidebar' => true])

@section('titulo_pagina', 'Nuevo Usuario')

@section('contenido')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-plus mr-2 text-dark"></i> Crear Usuario
        </h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Volver al listado
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Registro</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Nombre de Usuario <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="password">Contraseña <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="form-text text-muted">Mínimo 8 caracteres.</small>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="rol">Rol del Usuario <span class="text-danger">*</span></label>
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="">Selecciona un rol...</option>
                            <option value="veterinario" {{ old('rol') == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                            <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="activo" name="activo" value="1" {{ old('activo', '1') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="activo">Usuario Activo</label>
                    </div>
                    <small class="form-text text-muted">Si se desmarca, el usuario no podrá iniciar sesión.</small>
                </div>

                <hr>

                <div class="text-right">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
