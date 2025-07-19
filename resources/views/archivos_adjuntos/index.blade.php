@extends('layouts.app')

@section('title', 'Gestión de Archivos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Archivos del Curso</h2>
            <a href="{{ route('archivos_adjuntos.create') }}" class="btn btn-primary">Subir Archivo</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($archivos->isEmpty())
            <div class="alert alert-warning">No hay archivos disponibles.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Curso</th>
                        <th>Nombre</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($archivos as $archivo)
                        <tr>
                            <td>{{ $archivo->curso->nombre ?? '—' }}</td>
                            <td>{{ $archivo->nombre }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $archivo->ruta) }}" target="_blank">Ver archivo</a>
                            </td>
                            <td>
                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Eliminar este archivo?')">
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