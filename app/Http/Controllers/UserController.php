<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('modules.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('modules.admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        return view('modules.admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'activo' => $request->has('activo'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function show(User $user)
    {
        $hasDependencies = false;
        if ($user->veterinario && $user->veterinario->consultas()->exists()) {
            $hasDependencies = true;
        }

        return view('modules.admin.users.show', compact('user', 'hasDependencies'));
    }

    public function destroy(User $user)
    {
        if ($user->veterinario && $user->veterinario->consultas()->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'No se puede eliminar el usuario porque tiene registros de consultas asociados.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
