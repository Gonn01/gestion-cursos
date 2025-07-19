@extends('layouts.app')

@section('title', 'Listado de Cursos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de Cursos</h2>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary">Crear Curso</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($cursos->isEmpty())
            <div class="alert alert-warning">No hay cursos registrados.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Docente ID</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td>{{ $curso->nombre }}</td>
                            <td>{{ $curso->descripcion }}</td>
                            <td>{{ $curso->docente_id }}</td>
                            <td>
                                <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Eliminar curso?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection