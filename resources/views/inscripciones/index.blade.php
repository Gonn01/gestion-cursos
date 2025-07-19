@extends('layouts.app')

@section('title', 'Listado de Inscripciones')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Inscripciones</h2>
            <a href="{{ route('inscripciones.create') }}" class="btn btn-success">Nueva Inscripción</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($inscripciones->isEmpty())
            <div class="alert alert-warning">No hay inscripciones registradas.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $inscripcion)
                            <tr>
                                <td>{{ $inscripcion->alumno->nombre }}</td>
                                <td>{{ $inscripcion->curso->titulo }}</td>
                                <td>{{ $inscripcion->fecha }}</td>
                                <td class="text-end">
                                    <form action="{{ route('inscripciones.destroy', $inscripcion) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar inscripción?')" class="d-inline">
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