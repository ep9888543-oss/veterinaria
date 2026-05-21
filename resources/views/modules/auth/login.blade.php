@extends('layouts.auth')

@section('titulo_pagina', 'Iniciar Sesión')

@section('contenido')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        {{-- Panel izquierdo con logo --}}
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-gradient-primary">
                            <img src="{{ asset('img/logo1.jpeg') }}"
                                 alt="Logo Veterinaria"
                                 class="img-fluid"
                                 style="max-width: 80%; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        </div>

                        {{-- Formulario de login --}}
                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center mb-4">
                                    <i class="fas fa-paw fa-3x text-primary mb-3"></i>
                                    <h1 class="h4 text-gray-900">¡Bienvenido!</h1>
                                    <p class="text-muted small">Ingresa tus credenciales para continuar</p>
                                </div>

                                <form class="user" action="{{ route('logear') }}" method="POST">
                                    @csrf

                                    {{-- Email --}}
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Correo electrónico"
                                            required
                                            autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="form-group">
                                        <input
                                            type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password"
                                            name="password"
                                            placeholder="Contraseña"
                                            required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Error de credenciales --}}
                                    @if(session('error'))
                                        <div class="alert alert-danger text-center small py-2">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    {{-- Botón --}}
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <i class="fas fa-sign-in-alt mr-1"></i> Iniciar Sesión
                                    </button>

                                </form>

                            </div>
                        </div>
                        {{-- End of login form --}}

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
