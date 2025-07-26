@extends('layouts.app')

@section('title', 'Listado de Alumnos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de Alumnos</h2>
            <a href="{{ route('alumnos.form') }}" class="btn btn-primary">Registrar Alumno</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($alumnos->isEmpty())
            <div class="alert alert-warning">No hay alumnos registrados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Género</th>
                            <th>Fecha Nacimiento</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->nombre }}</td>
                                <td>{{ $alumno->apellido }}</td>
                                <td>{{ $alumno->dni }}</td>
                                <td>{{ $alumno->email }}</td>
                                <td>{{ $alumno->telefono }}</td>
                                <td>{{ $alumno->direccion }}</td>
                                <td>{{ ucfirst($alumno->genero) }}</td>
                                <td>{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}</td>
                                <td>{{ $alumno->activo ? 'Sí' : 'No' }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('alumnos.form', $alumno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Eliminar alumno?')">
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