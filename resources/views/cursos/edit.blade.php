@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
    <div class="container mt-4">
        <h2>Editar Curso</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cursos.update', $curso->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $curso->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control"
                    required>{{ old('descripcion', $curso->descripcion) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Docente ID</label>
                <input type="number" name="docente_id" class="form-control"
                    value="{{ old('docente_id', $curso->docente_id) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection