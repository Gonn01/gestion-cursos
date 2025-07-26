@extends('layouts.app')

@section('title', isset($docente) ? 'Editar Docente' : 'Nuevo Docente')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">{{ isset($docente) ? 'Editar Docente' : 'Nuevo Docente' }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($docente) ? route('docentes.update', $docente) : route('docentes.store') }}" method="POST"
            class="card p-4 shadow-sm">
            @csrf
            @if (isset($docente))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido', $docente->apellido ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $docente->dni ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $docente->email ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" value="{{ old('especialidad', $docente->especialidad ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $docente->telefono ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $docente->direccion ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">¿Está activo?</label>
                <select name="activo" class="form-select" required>
                    <option value="1" @selected(old('activo', $docente->activo ?? '') == '1')>Sí</option>
                    <option value="0" @selected(old('activo', $docente->activo ?? '') == '0')>No</option>
                </select>
            </div>

            <button class="btn btn-success">{{ isset($docente) ? 'Actualizar' : 'Guardar' }}</button>
        </form>
    </div>
@endsection