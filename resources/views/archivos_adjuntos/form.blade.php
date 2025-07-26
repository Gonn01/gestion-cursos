@extends('layouts.app')

@section('title', isset($archivo) ? 'Editar Archivo' : 'Subir Archivo')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">{{ isset($archivo) ? 'Editar Archivo' : 'Subir Archivo a un Curso' }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($archivo) ? route('archivos_adjuntos.update', $archivo) : route('archivos_adjuntos.store') }}"
            method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf
            @if (isset($archivo))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    <option value="">Seleccione un curso</option>
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id', $archivo->curso_id ?? '') == $curso->id)>
                            {{ $curso->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Archivo</label>
                <input type="file" name="archivo" class="form-control" {{ isset($archivo) ? '' : 'required' }}>
                @if (isset($archivo))
                    <small class="text-muted">Archivo actual: <a href="{{ asset($archivo->archivo) }}" target="_blank">Ver
                            archivo</a></small>
                @endif
            </div>

            <button class="btn btn-success">{{ isset($archivo) ? 'Actualizar' : 'Subir Archivo' }}</button>
        </form>
    </div>
@endsection