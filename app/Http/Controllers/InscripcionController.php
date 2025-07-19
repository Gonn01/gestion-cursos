<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['alumno', 'curso'])->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $alumnos = Alumno::all();
        $cursos = Curso::all();
        return view('inscripciones.create', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'estado' => 'required|in:activo,aprobado,desaprobado',
            'nota' => 'nullable|integer|min:1|max:10',
            'asistencia' => 'nullable|integer|min:0|max:100',
        ]);

        Inscripcion::create($request->all());
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada.');
    }

    public function edit(Inscripcion $inscripcion)
    {
        $alumnos = Alumno::all();
        $cursos = Curso::all();
        return view('inscripciones.edit', compact('inscripcion', 'alumnos', 'cursos'));
    }

    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'estado' => 'required|in:activo,aprobado,desaprobado',
            'nota' => 'nullable|integer|min:1|max:10',
            'asistencia' => 'nullable|integer|min:0|max:100',
        ]);

        $inscripcion->update($request->all());
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada.');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada.');
    }
}
