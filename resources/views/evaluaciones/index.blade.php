@extends('layouts.app')

@section('title', 'Listado de Evaluaciones')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Evaluaciones</h2>
            <a href="{{ route('evaluaciones.create') }}" class="btn btn-primary">Nueva Evaluación</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($evaluaciones->isEmpty())
            <div class="alert alert-warning">No hay evaluaciones cargadas.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Curso</th>
                        <th>Alumno</th>
                        <th>Fecha</th>
                        <th>Nota</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluaciones as $eva)
                        <tr>
                            <td>{{ $eva->curso->nombre ?? '—' }}</td>
                            <td>{{ $eva->alumno->nombre ?? '—' }}</td>
                            <td>{{ $eva->fecha }}</td>
                            <td>{{ $eva->nota }}</td>
                            <td>{{ $eva->observaciones }}</td>
                            <td>
                                <a href="{{ route('evaluaciones.edit', $eva->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('evaluaciones.destroy', $eva->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Eliminar evaluación?')">
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