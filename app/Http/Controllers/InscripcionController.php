<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with('alumno', 'curso')->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $alumnos = Alumno::where('activo', true)->get();
        $cursos = Curso::where('activo', true)->get();
        return view('inscripciones.create', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
        ]);

        $alumno = Alumno::findOrFail($request->alumno_id);

        // ✅ Verificación de estado
        if (!$alumno->activo) {
            return back()->withErrors(['alumno_id' => 'El alumno está inactivo.'])->withInput();
        }

        // ✅ Verificación de edad (mayor de 16 años)
        $edad = Carbon::parse($alumno->fecha_nacimiento)->age;
        if ($edad < 16) {
            return back()->withErrors(['alumno_id' => 'El alumno debe ser mayor de 16 años.'])->withInput();
        }

        // ✅ Verificación de cursos activos
        $cursosActivos = Inscripcion::where('alumno_id', $alumno->id)
            ->whereHas('curso', fn($q) => $q->where('activo', true))
            ->count();

        if ($cursosActivos >= 5) {
            return back()->withErrors(['alumno_id' => 'El alumno ya tiene 5 cursos activos.'])->withInput();
        }

        // ✅ Verificar si ya existe la inscripción
        $existe = Inscripcion::where('alumno_id', $request->alumno_id)
            ->where('curso_id', $request->curso_id)
            ->exists();

        if ($existe) {
            return back()->withErrors(['alumno_id' => 'El alumno ya está inscripto en este curso.'])->withInput();
        }

        Inscripcion::create($request->only('alumno_id', 'curso_id', 'fecha'));

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada.');
    }

    public function edit(Inscripcion $inscripcion)
    {
        $alumnos = Alumno::where('activo', true)->get();
        $cursos = Curso::where('activo', true)->get();
        return view('inscripciones.edit', compact('inscripcion', 'alumnos', 'cursos'));
    }

    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
        ]);

        // Validación extra: evitar inscripción de alumnos inactivos
        if (!$inscripcion->alumno->activo) {
            return back()->withErrors(['alumno_id' => 'El alumno está inactivo y no puede inscribirse.'])->withInput();
        }

        $inscripcion->update($request->only('alumno_id', 'curso_id', 'fecha'));

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada.');
    }
}
