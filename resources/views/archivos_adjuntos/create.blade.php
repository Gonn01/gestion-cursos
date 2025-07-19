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
                <label class="form-label">Nombre del archivo</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Archivo</label>
                <input type="file" name="archivo" class="form-control" required>
            </div>

            <button class="btn btn-success">Subir Archivo</button>
        </form>
    </div>
@endsection