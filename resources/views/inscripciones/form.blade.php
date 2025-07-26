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
                            {{ $alumno->nombre }} {{ $alumno->apellido }} ({{ $alumno->dni }})
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
                <input type="date" name="fecha_inscripcion" value="{{ old('fecha_inscripcion', now()->format('Y-m-d')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="activo" @selected(old('estado') == 'activo')>Activo</option>
                    <option value="aprobado" @selected(old('estado') == 'aprobado')>Aprobado</option>
                    <option value="desaprobado" @selected(old('estado') == 'desaprobado')>Desaprobado</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Asistencias</label>
                <input type="number" name="asistencias" value="{{ old('asistencias', 0) }}" class="form-control" min="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
            </div>

            <input type="hidden" name="nota_final" value="{{ old('nota_final') }}">
            <input type="hidden" name="evaluado_por_docente" value="0">

            <button class="btn btn-success">Guardar Inscripción</button>
        </form>
    </div>
@endsection