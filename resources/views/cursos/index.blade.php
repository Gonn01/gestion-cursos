@extends('layouts.app')

@section('title', 'Listado de Cursos')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4">Listado de Cursos</h2>
        <a href="{{ route('cursos.form') }}" class="btn btn-success">Nuevo Curso</a>
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
                            <td>{{ $curso->docente->nombre }} {{ $curso->docente->apellido }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d/m/Y') }}
                                al
                                {{ \Carbon\Carbon::parse($curso->fecha_fin)->format('d/m/Y') }}
                            </td>
                            <td>{{ $curso->cupo_maximo }}</td>
                            <td>
                                @switch($curso->estado)
                                    @case('activo') <span class="badge bg-success">Activo</span> @break
                                    @case('finalizado') <span class="badge bg-secondary">Finalizado</span> @break
                                    @case('cancelado') <span class="badge bg-danger">Cancelado</span> @break
                                @endswitch
                            </td>
                            <td class="text-end">
                                <a href="{{ route('cursos.form', $curso) }}" class="btn btn-sm btn-warning">Editar</a>
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
