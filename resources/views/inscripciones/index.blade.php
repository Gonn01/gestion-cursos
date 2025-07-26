@extends('layouts.app')

@section('title', 'Listado de Inscripciones')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Inscripciones</h2>
        <a href="{{ route('inscripciones.form') }}" class="btn btn-success">Nueva Inscripción</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($inscripciones->isEmpty())
        <div class="alert alert-warning">No hay inscripciones registradas.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Alumno</th>
                        <th>Curso</th>
                        <th>Fecha de Inscripción</th>
                        <th>Estado</th>
                        <th>Asistencias</th>
                        <th>Nota Final</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $inscripcion->alumno->nombre }} {{ $inscripcion->alumno->apellido }}</td>
                            <td>{{ $inscripcion->curso->titulo }}</td>
                            <td>{{ \Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d/m/Y') }}</td>
                            <td>
                                @switch($inscripcion->estado)
                                    @case('activo') <span class="badge bg-primary">Activo</span> @break
                                    @case('aprobado') <span class="badge bg-success">Aprobado</span> @break
                                    @case('desaprobado') <span class="badge bg-danger">Desaprobado</span> @break
                                @endswitch
                            </td>
                            <td>{{ $inscripcion->asistencias }}%</td>
                            <td>{{ $inscripcion->nota_final ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('inscripciones.form', $inscripcion) }}" class="btn btn-sm btn-warning">Editar</a>
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
