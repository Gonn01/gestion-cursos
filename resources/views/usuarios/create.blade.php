@extends('layouts.app')

@section('title', isset($usuario) ? 'Editar Usuario' : 'Nuevo Usuario')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">{{ isset($usuario) ? 'Editar Usuario' : 'Crear Usuario' }}</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($usuario) ? route('usuarios.update', $usuario->id) : route('usuarios.store') }}"
            method="POST" class="card p-4 shadow-sm">
            @csrf
            @if(isset($usuario))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $usuario->name ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $usuario->email ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin" @selected(old('rol', $usuario->rol ?? '') == 'admin')>Admin</option>
                    <option value="coordinador" @selected(old('rol', $usuario->rol ?? '') == 'coordinador')>Coordinador
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña {{ isset($usuario) ? '(dejar vacío para mantener)' : '' }}</label>
                <input type="password" name="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
            </div>

            <button class="btn btn-success">{{ isset($usuario) ? 'Actualizar' : 'Guardar' }}</button>
        </form>
    </div>
@endsection