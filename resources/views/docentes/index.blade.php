@extends('layouts.app')

@section('title', 'Listado de Docentes')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Listado de Docentes</h2>
            <a href="{{ route('docentes.create') }}" class="btn btn-success">Nuevo Docente</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($docentes->isEmpty())
            <div class="alert alert-warning">No hay docentes registrados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Email</th>
                            <th>Fecha Nacimiento</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docentes as $docente)
                            <tr>
                                <td>{{ $docente->nombre }}</td>
                                <td>{{ $docente->dni }}</td>
                                <td>{{ $docente->email }}</td>
                                <td>{{ $docente->fecha_nacimiento }}</td>
                                <td>{{ $docente->activo ? 'Activo' : 'Inactivo' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('docentes.edit', $docente) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('docentes.destroy', $docente) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Eliminar docente?')">
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