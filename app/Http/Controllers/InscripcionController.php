<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $cursos = Curso::where('estado', 'activo')->get();

        return view('inscripciones.form', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|in:activo,aprobado,desaprobado',
            'nota_final' => 'nullable|integer|min:1|max:10',
            'asistencias' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $alumno = Alumno::findOrFail($request->alumno_id);

        if (!$alumno->activo) {
            return back()->withErrors(['alumno_id' => 'El alumno está inactivo.'])->withInput();
        }

        if (Carbon::parse($alumno->fecha_nacimiento)->age < 16) {
            return back()->withErrors(['alumno_id' => 'El alumno debe tener al menos 16 años.'])->withInput();
        }

        $inscripcionesActivas = Inscripcion::where('alumno_id', $alumno->id)
            ->where('estado', 'activo')
            ->count();

        if ($inscripcionesActivas >= 5) {
            return back()->withErrors(['alumno_id' => 'El alumno ya tiene 5 cursos activos.'])->withInput();
        }

        $yaInscripto = Inscripcion::where('alumno_id', $request->alumno_id)
            ->where('curso_id', $request->curso_id)
            ->exists();

        if ($yaInscripto) {
            return back()->withErrors(['alumno_id' => 'El alumno ya está inscripto en este curso.'])->withInput();
        }

        Inscripcion::create([
            'alumno_id' => $request->alumno_id,
            'curso_id' => $request->curso_id,
            'fecha_inscripcion' => $request->fecha_inscripcion,
            'estado' => $request->estado,
            'nota_final' => $request->nota_final,
            'asistencias' => $request->asistencias ?? 0,
            'observaciones' => $request->observaciones,
            'evaluado_por_docente' => false,
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada.');
    }

    public function edit(Inscripcion $inscripcion)
    {
        $alumnos = Alumno::where('activo', true)->get();
        $cursos = Curso::where('estado', 'activo')->get();

        return view('inscripciones.form', compact('inscripcion', 'alumnos', 'cursos'));
    }

    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|in:activo,aprobado,desaprobado',
            'nota_final' => 'nullable|integer|min:1|max:10',
            'asistencias' => 'nullable|integer|min:0',
            'observaciones' => 'nullable|string',
        ]);

        $inscripcion->update($request->only([
            'alumno_id',
            'curso_id',
            'fecha_inscripcion',
            'estado',
            'nota_final',
            'asistencias',
            'observaciones'
        ]));

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada.');
    }
}
