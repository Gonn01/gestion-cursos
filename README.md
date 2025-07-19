en alumnos falta telefono y direccion género

verificar reglas
Reglas:
- Mayor de 16 años
- Email válido y único
- No puede inscribirse si está inactivo
- No puede tener más de 5 cursos activos simultáneamente




en docentes falta telefono y direccion y especialidad
verificar reglas
Reglas:
- No pueden asignarse cursos nuevos a docentes inactivos.
- Email válido y único.
- Un docente no puede tener más de 3 cursos activos.




3) Cursos:
Campos:
 id
 titulo
 descripción
 fecha_inicio
 fecha_fin
 estado (enum: activo, finalizado, cancelado)
 modalidad (enum: presencial, virtual, hibrido)
 aula_virtual (nullable, obligatorio si es virtual/hibrido)
 cupos_maximos (int, default: 30)
 docente_id (FK)
Reglas:
- fecha_fin debe ser posterior a fecha_inicio.
- No puede finalizar si no tiene alumnos.
- No puede superar el cupo máximo.
- Solo cursos activos pueden aceptar nuevas inscripciones.
Relaciones:
- Pertenece a un docente.
