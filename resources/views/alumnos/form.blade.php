@extends('layouts.app')

@section('title', isset($alumno) ? 'Editar Alumno' : 'Registrar Alumno')

@section('content')
    <div class="container mt-4">
        <h2>{{ isset($alumno) ? 'Editar Alumno' : 'Registrar Alumno' }}</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($alumno) ? route('alumnos.update', $alumno) : route('alumnos.store') }}" method="POST"
            class="card p-4 shadow-sm">
            @csrf
            @if(isset($alumno))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $alumno->nombre ?? '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control"
                    value="{{ old('apellido', $alumno->apellido ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{ old('dni', $alumno->dni ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $alumno->email ?? '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control"
                    value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                    value="{{ old('telefono', $alumno->telefono ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control"
                    value="{{ old('direccion', $alumno->direccion ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="genero" class="form-select" required>
                    <option value="">Seleccionar</option>
                    <option value="masculino" @selected(old('genero', $alumno->genero ?? '') == 'masculino')>Masculino
                    </option>
                    <option value="femenino" @selected(old('genero', $alumno->genero ?? '') == 'femenino')>Femenino</option>
                    <option value="otro" @selected(old('genero', $alumno->genero ?? '') == 'otro')>Otro</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Activo</label>
                <select name="activo" class="form-select" required>
                    <option value="1" @selected(old('activo', $alumno->activo ?? '') == 1)>Sí</option>
                    <option value="0" @selected(old('activo', $alumno->activo ?? '') == 0)>No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($alumno) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection