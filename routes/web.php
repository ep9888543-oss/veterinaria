<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

// Rutas compartidas por autenticados
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

use App\Http\Controllers\ExpedienteController;

// Rutas exclusivas para veterinarios
Route::middleware(['auth', 'role:veterinario'])->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/expedientes', [ExpedienteController::class, 'index'])->name('veterinario.expedientes');
    Route::get('/expedientes/buscar', [ExpedienteController::class, 'buscar'])->name('veterinario.expedientes.buscar');
    Route::get('/expedientes/{id}/consultas', [ExpedienteController::class, 'showConsultasVeterinario'])->name('veterinario.expedientes.consultas');
    Route::get('/expedientes/{mascota}/consultas/{consulta}', [ExpedienteController::class, 'showDetalleConsultaVeterinario'])->name('veterinario.expedientes.consultas.show');
    Route::get('/expedientes/{mascota}/consultas/{consulta}/diagnostico', [ExpedienteController::class, 'diagnosticoVeterinario'])->name('veterinario.expedientes.consultas.diagnostico');
});

use App\Http\Controllers\UserController;

// Rutas exclusivas para administradores
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/usuarios/{user}/eliminar', [UserController::class, 'show'])->name('admin.users.show');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/expedientes', [ExpedienteController::class, 'indexAdmin'])->name('admin.expedientes');
    Route::get('/expedientes/buscar', [ExpedienteController::class, 'buscar'])->name('admin.expedientes.buscar');
    Route::get('/expedientes/{id}/consultas', [ExpedienteController::class, 'showConsultasAdmin'])->name('admin.expedientes.consultas');
    Route::get('/expedientes/{mascota}/consultas/{consulta}', [ExpedienteController::class, 'showDetalleConsultaAdmin'])->name('admin.expedientes.consultas.show');
    Route::get('/expedientes/{mascota}/consultas/{consulta}/diagnostico', [ExpedienteController::class, 'diagnosticoAdmin'])->name('admin.expedientes.consultas.diagnostico');
});
