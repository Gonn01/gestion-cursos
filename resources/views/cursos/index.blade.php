@extends('layouts.app')

@section('title', 'Listado de Cursos')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4">Listado de Cursos</h2>
            <a href="{{ route('cursos.create') }}" class="btn btn-success">Nuevo Curso</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($cursos->isEmpty())
            <div class="alert alert-warning">No hay cursos registrados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Modalidad</th>
                            <th>Docente</th>
                            <th>Fechas</th>
                            <th>Cupo</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $curso)
                            <tr>
                                <td>{{ $curso->titulo }}</td>
                                <td>{{ ucfirst($curso->modalidad) }}</td>
                                <td>{{ $curso->docente->nombre }}</td>
                                <td>{{ $curso->fecha_inicio }} al {{ $curso->fecha_fin }}</td>
                                <td>{{ $curso->cupo_maximo }}</td>
                                <td>{{ $curso->activo ? 'Activo' : 'Inactivo' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline"
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
            </div>
        @endif
    </div>
@endsection