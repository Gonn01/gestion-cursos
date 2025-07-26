@extends('layouts.app')

@section('title', 'Subir Archivo')

@section('content')
    <div class="container mt-5">
        <h2 class="h4 mb-4">Subir Archivo a un Curso</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('archivos_adjuntos.store') }}" method="POST" enctype="multipart/form-data"
            class="card p-4 shadow-sm">
            @csrf

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
                <label class="form-label">Título del archivo</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de archivo</label>
                <select name="tipo" class="form-select" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="tarea" @selected(old('tipo') == 'tarea')>Tarea</option>
                    <option value="material" @selected(old('tipo') == 'material')>Material</option>
                    <option value="guía" @selected(old('tipo') == 'guía')>Guía</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Archivo (PDF, DOCX, PPT, JPG, PNG)</label>
                <input type="file" name="archivo" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-success">Subir Archivo</button>
                <a href="{{ route('archivos_adjuntos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection