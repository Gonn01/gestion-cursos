@extends('layouts.app')

@section('title', 'Archivos del Curso')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Archivos Adjuntos</h2>
            <a href="{{ route('archivos.create') }}" class="btn btn-success">Subir Archivo</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($archivos->isEmpty())
            <div class="alert alert-warning">No hay archivos subidos.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Curso</th>
                        <th>Nombre</th>
                        <th>Archivo</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($archivos as $archivo)
                        <tr>
                            <td>{{ $archivo->curso->titulo }}</td>
                            <td>{{ $archivo->nombre }}</td>
                            <td><a href="{{ asset('storage/' . $archivo->ruta) }}" target="_blank">Ver</a></td>
                            <td class="text-end">
                                <form action="{{ route('archivos.destroy', $archivo) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar archivo?')" class="d-inline">
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