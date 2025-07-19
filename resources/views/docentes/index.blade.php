@extends('layouts.app')

@section('title', 'Listado de Docentes')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de Docentes</h2>
            <a href="{{ route('docentes.create') }}" class="btn btn-primary">Registrar Docente</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($docentes->isEmpty())
            <div class="alert alert-warning">No hay docentes registrados.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            <td>{{ $docente->nombre }}</td>
                            <td>{{ $docente->especialidad }}</td>
                            <td>{{ $docente->email }}</td>
                            <td>
                                <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" class="d-inline"
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
        @endif
    </div>
@endsection