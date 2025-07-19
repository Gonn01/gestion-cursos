@extends('layouts.app')

@section('title', isset($curso) ? 'Editar Curso' : 'Nuevo Curso')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">{{ isset($curso) ? 'Editar Curso' : 'Nuevo Curso' }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($curso) ? route('cursos.update', $curso) : route('cursos.store') }}" method="POST"
            class="card p-4 shadow-sm">
            @csrf
            @if (isset($curso))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $curso->titulo ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion"
                    class="form-control">{{ old('descripcion', $curso->descripcion ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Modalidad</label>
                <select name="modalidad" class="form-select" required>
                    <option value="presencial" @selected(old('modalidad', $curso->modalidad ?? '') == 'presencial')>Presencial
                    </option>
                    <option value="virtual" @selected(old('modalidad', $curso->modalidad ?? '') == 'virtual')>Virtual</option>
                    <option value="hibrido" @selected(old('modalidad', $curso->modalidad ?? '') == 'hibrido')>Híbrido</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Aula Virtual (si aplica)</label>
                <input type="text" name="aula_virtual" value="{{ old('aula_virtual', $curso->aula_virtual ?? '') }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $curso->fecha_inicio ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $curso->fecha_fin ?? '') }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cupo Máximo</label>
                <input type="number" name="cupo_maximo" value="{{ old('cupo_maximo', $curso->cupo_maximo ?? '') }}"
                    class="form-control" required min="1">
            </div>

            <div class="mb-3">
                <label class="form-label">Docente</label>
                <select name="docente_id" class="form-select" required>
                    <option value="">Seleccione uno</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id }}" @selected(old('docente_id', $curso->docente_id ?? '') == $docente->id)>
                            {{ $docente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">{{ isset($curso) ? 'Actualizar' : 'Guardar' }}</button>
        </form>
    </div>
@endsection