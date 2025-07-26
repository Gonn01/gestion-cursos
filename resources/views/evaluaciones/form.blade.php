@extends('layouts.app')

@section('title', isset($evaluacion) ? 'Editar Evaluación' : 'Nueva Evaluación')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">{{ isset($evaluacion) ? 'Editar Evaluación' : 'Nueva Evaluación' }}</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($evaluacion) ? route('evaluaciones.update', $evaluacion) : route('evaluaciones.store') }}"
            method="POST" class="card p-4 shadow-sm">
            @csrf
            @if(isset($evaluacion))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" @selected(old('alumno_id', $evaluacion->alumno_id ?? '') == $alumno->id)>
                            {{ $alumno->nombre }} {{ $alumno->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id', $evaluacion->curso_id ?? '') == $curso->id)>
                            {{ $curso->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $evaluacion->descripcion ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha', $evaluacion->fecha ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nota</label>
                <input type="number" name="nota" min="1" max="10" value="{{ old('nota', $evaluacion->nota ?? '') }}"
                    class="form-control" required>
            </div>

            <button class="btn btn-success">{{ isset($evaluacion) ? 'Actualizar' : 'Guardar' }}</button>
        </form>
    </div>
@endsection