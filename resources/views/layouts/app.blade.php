<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gestión') - Consultorio</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .navbar {
            background-color: #1e1e1e !important;
        }

        .nav-link {
            color: #e0e0e0 !important;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #0dcaf0 !important;
        }

        .card {
            background-color: #1e1e1e;
            border: 1px solid #2c2c2c;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-info fw-bold" href="#">Consultorio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    {{-- Alumnos: admin y coordinador --}}
                    @if(in_array(Auth::user()->rol, ['admin', 'coordinador']))
                        <li class="nav-item"><a class="nav-link" href="{{ route('alumnos.index') }}">Alumnos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('inscripciones.index') }}">Inscripciones</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('evaluaciones.index') }}">Evaluaciones</a>
                        </li>
                    @endif

                    {{-- Docentes y Cursos: solo admin --}}
                    @if(Auth::user()->rol === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('docentes.index') }}">Docentes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cursos.index') }}">Cursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('archivos_adjuntos.index') }}">Archivos</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    @endif
                </ul>

                <!-- Botón de logout con el nombre del usuario -->
                <div class="d-flex align-items-center">
                    <span class="me-3 text-light">👤 {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>