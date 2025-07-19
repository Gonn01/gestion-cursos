@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">Editar Inscripción</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inscripciones.update', $inscripcion) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" @selected(old('alumno_id', $inscripcion->alumno_id) == $alumno->id)>
                            {{ $alumno->nombre }} ({{ $alumno->dni }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id', $inscripcion->curso_id) == $curso->id)>
                            {{ $curso->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Inscripción</label>
                <input type="date" name="fecha" value="{{ old('fecha', $inscripcion->fecha) }}" class="form-control"
                    required>
            </div>

            <button class="btn btn-primary">Actualizar Inscripción</button>
        </form>
    </div>
@endsection