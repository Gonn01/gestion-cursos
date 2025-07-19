@extends('layouts.app')

@section('title', 'Nueva Inscripción')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">Inscribir Alumno a un Curso</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inscripciones.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    <option value="">Seleccione un alumno</option>
                    @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" @selected(old('alumno_id') == $alumno->id)>
                            {{ $alumno->nombre }} ({{ $alumno->dni }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id') == $curso->id)>
                            {{ $curso->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Inscripción</label>
                <input type="date" name="fecha" value="{{ old('fecha', now()->format('Y-m-d')) }}" class="form-control"
                    required>
            </div>

            <button class="btn btn-success">Guardar Inscripción</button>
        </form>
    </div>
@endsection