@extends('layouts.app')

@section('title', 'Nueva Evaluación')

@section('content')
<div class="container mt-4">
    <h2>Nueva Evaluación</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('evaluaciones.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Curso</label>
            <select name="curso_id" class="form-select" required>
                <option value="">Seleccionar</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" @selected(old('curso_id')==$curso->id)>{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alumno</label>
            <select name="alumno_id" class="form-select" required>
                <option value="">Seleccionar</option>
                @foreach($alumnos as $alumno)
                <option value="{{ $alumno->id }}" @selected(old('alumno_id')==$alumno->id)>{{ $alumno->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nota</label>
            <input type="number" name="nota" class="form-control" value="{{ old('nota') }}" min="1" max="10">
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection