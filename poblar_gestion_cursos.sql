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

INSERT INTO users
    (id, name, email, password, rol, created_at, updated_at)
VALUES
    (1, 'Admin', 'admin@example.com', '$2y$12$EXAMPLEHASHEDPASSWORD', 'admin', NOW(), NOW()),
    (2, 'Coordinador', 'coordinador@example.com', '$2y$12$EXAMPLEHASHEDPASSWORD', 'coordinador', NOW(), NOW());

INSERT INTO docentes
    (id, nombre, apellido, dni, email, especialidad, telefono, direccion, activo, created_at, updated_at)
VALUES
    (1, 'Carlos', 'Pérez', '30123456', 'carlos.perez@example.com', 'Programación', '1111111111', 'Calle Docente 123', 1, NOW(), NOW()),
    (2, 'Laura', 'Gómez', '32123456', 'laura.gomez@example.com', 'Diseño Web', '2222222222', 'Av Docente 456', 1, NOW(), NOW()),
    (3, 'Martín', 'Rodríguez', '33123456', 'martin.rodriguez@example.com', 'Bases de Datos', '3333333333', 'Calle BD 789', 1, NOW(), NOW());

INSERT INTO alumnos
    (id, nombre, apellido, dni, email, fecha_nacimiento, telefono, direccion, genero, activo, created_at, updated_at)
VALUES
    (1, 'Juan', 'García', '40123456', 'juan.garcia@example.com', '2003-03-10', '1234567890', 'Calle Falsa 123', 'masculino', 1, NOW(), NOW()),
    (2, 'María', 'López', '40123457', 'maria.lopez@example.com', '2001-07-22', '0987654321', 'Av Siempreviva 742', 'femenino', 1, NOW(), NOW()),
    (3, 'Lucía', 'Martínez', '40123458', 'lucia.martinez@example.com', '2000-05-15', '111222333', 'Calle 12 N°456', 'femenino', 1, NOW(), NOW()),
    (4, 'Diego', 'Fernández', '40123459', 'diego.fernandez@example.com', '1999-02-28', '444555666', 'Av Corrientes 1500', 'masculino', 0, NOW(), NOW()),
    (5, 'Ana', 'Suárez', '40123460', 'ana.suarez@example.com', '2004-11-12', '555666777', 'San Martín 200', 'femenino', 1, NOW(), NOW());

INSERT INTO cursos
    (id, titulo, descripcion, modalidad, aula_virtual, fecha_inicio, fecha_fin, cupo_maximo, estado, docente_id, created_at, updated_at)
VALUES
    (1, 'Programación I', 'Curso introductorio de programación', 'virtual', 'http://aula1.com', '2025-08-01', '2025-10-31', 30, 'activo', 1, NOW(), NOW()),
    (2, 'Diseño Web', 'Fundamentos del diseño web', 'presencial', NULL, '2025-08-10', '2025-11-01', 25, 'activo', 2, NOW(), NOW()),
    (3, 'Bases de Datos', 'Modelado y consultas SQL', 'hibrido', 'http://aula2.com', '2025-09-01', '2025-12-15', 20, 'activo', 3, NOW(), NOW()),
    (4, 'Redes Informáticas', 'Principios de redes y seguridad', 'virtual', 'http://aula3.com', '2025-09-05', '2025-12-20', 30, 'activo', 1, NOW(), NOW());

INSERT INTO inscripciones
    (id, alumno_id, curso_id, fecha_inscripcion, estado, nota_final, asistencias, observaciones, evaluado_por_docente, created_at, updated_at)
VALUES
    (1, 1, 1, '2025-07-15', 'activo', NULL, 80, NULL, 0, NOW(), NOW()),
    (2, 2, 1, '2025-07-15', 'activo', NULL, 70, NULL, 0, NOW(), NOW()),
    (3, 1, 2, '2025-07-16', 'activo', NULL, 90, NULL, 0, NOW(), NOW()),
    (4, 3, 3, '2025-08-02', 'activo', NULL, 100, 'Muy participativa', 0, NOW(), NOW()),
    (5, 4, 2, '2025-08-05', 'activo', NULL, 60, 'Alumno inactivo, revisar', 0, NOW(), NOW()),
    (6, 5, 4, '2025-08-08', 'activo', NULL, 85, 'Buen desempeño inicial', 0, NOW(), NOW());

INSERT INTO evaluaciones
    (id, alumno_id, curso_id, descripcion, nota, fecha, created_at, updated_at)
VALUES
    (1, 1, 1, 'Parcial 1', 8, '2025-08-20', NOW(), NOW()),
    (2, 2, 1, 'Parcial 1', 9, '2025-08-20', NOW(), NOW()),
    (3, 1, 2, 'Trabajo Práctico 1', 7, '2025-09-10', NOW(), NOW()),
    (4, 3, 3, 'Examen Teórico', 10, '2025-09-25', NOW(), NOW()),
    (5, 5, 4, 'Parcial Redes', 6, '2025-09-30', NOW(), NOW());

INSERT INTO archivos_adjuntos
    (id, curso_id, titulo, archivo_url, tipo, fecha_subida, created_at, updated_at)
VALUES
    (1, 1, 'Apuntes Iniciales', 'programacion1_apuntes.pdf', 'material', '2025-07-15', NOW(), NOW()),
    (2, 2, 'Tarea Diseño', 'diseno_tarea1.jpg', 'tarea', '2025-07-16', NOW(), NOW()),
    (3, 3, 'Guía SQL', 'bases_sql.pdf', 'guía', '2025-08-20', NOW(), NOW()),
    (4, 4, 'Presentación Seguridad', 'redes_seguridad.ppt', 'material', '2025-09-01', NOW(), NOW()),
    (5, 4, DEFAULT, 'redes_topologias.pdf', 'material', '2025-09-02', NOW(), NOW());

ALTER TABLE archivos_adjuntos MODIFY tipo VARCHAR
(10);
ALTER TABLE archivos_adjuntos MODIFY fecha_subida DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE archivos_adjuntos MODIFY titulo VARCHAR
(255) DEFAULT 'Sin título';
