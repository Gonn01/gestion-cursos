@extends('layouts.app')

@section('title', 'Archivos del Curso')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Archivos Adjuntos</h2>
            <a href="{{ route('archivos_adjuntos.form') }}" class="btn btn-success">Subir Archivo</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($archivos->isEmpty())
            <div class="alert alert-warning">No hay archivos subidos.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Curso</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Archivo</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($archivos as $archivo)
                            <tr>
                                <td>{{ $archivo->curso->titulo }}</td>
                                <td>{{ $archivo->titulo }}</td>
                                <td>{{ ucfirst($archivo->tipo) }}</td>
                                <td>
                                    <a href="{{ asset($archivo->archivo_url) }}" target="_blank">Ver</a>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('archivos_adjuntos.destroy', $archivo) }}" method="POST"
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
            </div>
        @endif
    </div>
@endsection