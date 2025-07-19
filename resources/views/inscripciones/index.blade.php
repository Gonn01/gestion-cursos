@extends('layouts.app')

@section('title', 'Listado de Inscripciones')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de Inscripciones</h2>
            <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">Nueva Inscripción</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($inscripciones->isEmpty())
            <div class="alert alert-warning">No hay inscripciones registradas.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Alumno ID</th>
                        <th>Curso ID</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $inscripcion->alumno_id }}</td>
                            <td>{{ $inscripcion->curso_id }}</td>
                            <td>{{ $inscripcion->fecha }}</td>
                            <td>
                                <a href="{{ route('inscripciones.edit', $inscripcion->id) }}"
                                    class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Eliminar inscripción?')">
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