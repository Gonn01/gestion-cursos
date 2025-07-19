@extends('layouts.app')

@section('title', 'Listado de Alumnos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Listado de Alumnos</h2>
            <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Registrar Alumno</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($alumnos->isEmpty())
            <div class="alert alert-warning">No hay alumnos registrados.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Fecha Nacimiento</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->dni }}</td>
                            <td>{{ $alumno->email }}</td>
                            <td>{{ $alumno->fecha_nacimiento }}</td>
                            <td>{{ $alumno->activo ? 'Sí' : 'No' }}</td>
                            <td>
                                <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-warning">Editar</a>
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
        @endif
    </div>
@endsection