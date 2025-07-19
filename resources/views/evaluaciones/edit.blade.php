@extends('layouts.app')

@section('title', 'Editar Evaluación')

@section('content')
    <div class="container mt-4">
        <h2>Editar Evaluación</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evaluaciones.update', $evaluacion->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id', $evaluacion->curso_id) == $curso->id)>
                            {{ $curso->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    @foreach($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" @selected(old('alumno_id', $evaluacion->alumno_id) == $alumno->id)>
                            {{ $alumno->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $evaluacion->fecha) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nota</label>
                <input type="number" name="nota" class="form-control" value="{{ old('nota', $evaluacion->nota) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones"
                    class="form-control">{{ old('observaciones', $evaluacion->observaciones) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('evaluaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection