@extends('layouts.app')

@section('title', 'Subir Archivo')

@section('content')
    <div class="container mt-4">
        <h2>Subir nuevo archivo</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="curso_id" class="form-select" required>
                    <option value="">Seleccionar</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" @selected(old('curso_id') == $curso->id)>{{ $curso->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre del archivo</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Archivo</label>
                <input type="file" name="archivo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Subir</button>
            <a href="{{ route('archivos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection