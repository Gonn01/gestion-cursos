@extends('layouts.app')

@section('title', 'Listado de Evaluaciones')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Evaluaciones</h2>
            <a href="{{ route('evaluaciones.form') }}" class="btn btn-success">Nueva Evaluación</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($evaluaciones->isEmpty())
            <div class="alert alert-warning">No hay evaluaciones registradas.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Nota</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluaciones as $eval)
                            <tr>
                                <td>{{ $eval->alumno->nombre }} {{ $eval->alumno->apellido }}</td>
                                <td>{{ $eval->curso->titulo }}</td>
                                <td>{{ $eval->descripcion }}</td>
                                <td>{{ \Carbon\Carbon::parse($eval->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $eval->nota }}</td>
                                <td class="text-end">
                                    <a href="{{ route('evaluaciones.form', $eval) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('evaluaciones.destroy', $eval) }}" method="POST" class="d-inline"
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
            </div>
        @endif
    </div>
@endsection