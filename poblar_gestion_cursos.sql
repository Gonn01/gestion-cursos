USE gestion_cursos;

SET FOREIGN_KEY_CHECKS
= 0;

TRUNCATE TABLE archivos_adjuntos;
TRUNCATE TABLE evaluaciones;
TRUNCATE TABLE inscripciones;
TRUNCATE TABLE cursos;
TRUNCATE TABLE alumnos;
TRUNCATE TABLE docentes;
TRUNCATE TABLE users;

SET FOREIGN_KEY_CHECKS
= 1;

-- USUARIOS
INSERT INTO users
    (id, name, email, password, rol, created_at, updated_at)
VALUES
    (1, 'admin', 'admin@example.com', '$2y$12$EXAMPLEHASHEDPASSWORD', 'admin', '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (2, 'coordinador', 'coordinador@example.com', '$2y$12$EXAMPLEHASHEDPASSWORD', 'coordinador', '2025-07-26 14:21:02', '2025-07-26 14:21:02');

-- DOCENTES
INSERT INTO docentes
    (id, nombre, apellido, dni, email, especialidad, telefono, direccion, activo, created_at, updated_at)
VALUES
    (1, 'Carlos', 'Pérez', '30123456', 'carlos.perez@example.com', 'Programación', '1111111111', 'Calle Docente 123', 1, NOW(), NOW()),
    (2, 'Laura', 'Gómez', '32123456', 'laura.gomez@example.com', 'Diseño Web', '2222222222', 'Av Docente 456', 1, NOW(), NOW());

-- ALUMNOS
INSERT INTO alumnos
    (id, nombre, apellido, dni, email, fecha_nacimiento, telefono, direccion, genero, activo, created_at, updated_at)
VALUES
    (1, 'Juan', 'García', '40123456', 'juan.garcia@example.com', '2003-03-10', '1234567890', 'Calle Falsa 123', 'masculino', 1, '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (2, 'María', 'López', '40123457', 'maria.lopez@example.com', '2001-07-22', '0987654321', 'Av Siempreviva 742', 'femenino', 1, '2025-07-26 14:21:02', '2025-07-26 14:21:02');

-- CURSOS
INSERT INTO cursos
    (id, titulo, descripcion, modalidad, aula_virtual, fecha_inicio, fecha_fin, cupo_maximo, estado, docente_id, created_at, updated_at)
VALUES
    (1, 'Programación I', 'Curso introductorio de programación', 'virtual', 'http://aula1.com', '2025-08-01', '2025-10-31', 30, 'activo', 1, NOW(), NOW()),
    (2, 'Diseño Web', 'Fundamentos del diseño web', 'presencial', NULL, '2025-08-10', '2025-11-01', 25, 'activo', 2, NOW(), NOW());

-- INSCRIPCIONES
INSERT INTO inscripciones
    (id, alumno_id, curso_id, fecha_inscripcion, estado, nota_final, asistencias, observaciones, evaluado_por_docente, created_at, updated_at)
VALUES
    (1, 1, 1, '2025-07-15', 'activo', NULL, 0, NULL, 0, '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (2, 2, 1, '2025-07-15', 'activo', NULL, 0, NULL, 0, '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (3, 1, 2, '2025-07-15', 'activo', NULL, 0, NULL, 0, '2025-07-26 14:21:02', '2025-07-26 14:21:02');

-- EVALUACIONES
INSERT INTO evaluaciones
    (id, alumno_id, curso_id, descripcion, nota, fecha, created_at, updated_at)
VALUES
    (1, 1, 1, 'Parcial 1', 8, '2025-08-20', '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (2, 2, 1, 'Parcial 1', 9, '2025-08-20', '2025-07-26 14:21:02', '2025-07-26 14:21:02');

-- ARCHIVOS ADJUNTOS
INSERT INTO archivos_adjuntos
    (id, curso_id, titulo, archivo_url, tipo, fecha_subida, created_at, updated_at)
VALUES
    (1, 1, 'Apuntes Iniciales', 'programacion1_apuntes.pdf', 'material', '2025-07-15', '2025-07-26 14:21:02', '2025-07-26 14:21:02'),
    (2, 2, 'Tarea Diseño', 'diseno_tarea1.jpg', 'tarea', '2025-07-16', '2025-07-26 14:21:02', '2025-07-26 14:21:02');
