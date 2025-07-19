@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
    <div class="container mt-4">
        <h2>Editar Inscripción</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">ID Alumno</label>
                <input type="number" name="alumno_id" class="form-control"
                    value="{{ old('alumno_id', $inscripcion->alumno_id) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ID Curso</label>
                <input type="number" name="curso_id" class="form-control"
                    value="{{ old('curso_id', $inscripcion->curso_id) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Inscripción</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $inscripcion->fecha) }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection