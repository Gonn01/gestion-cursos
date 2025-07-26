@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Listado de Usuarios</h2>
            <a href="{{ route('usuarios.form') }}" class="btn btn-success">Nuevo Usuario</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($usuarios->isEmpty())
            <div class="alert alert-warning">No hay usuarios registrados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ ucfirst($usuario->rol) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('usuarios.form', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Eliminar usuario?')">
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