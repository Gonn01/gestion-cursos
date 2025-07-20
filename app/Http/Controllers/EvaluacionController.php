<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Curso;

class EvaluacionController extends Controller
{
    public function index()
    {
        $evaluaciones = Evaluacion::with(['alumno', 'curso'])->get();
        return view('evaluaciones.index', compact('evaluaciones'));
    }

    public function create()
    {
        $alumnos = Alumno::all();
        $cursos = Curso::all();
        return view('evaluaciones.create', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'nota' => 'required|integer|min:1|max:10',
        ]);

        Evaluacion::create($request->all());
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación registrada.');
    }

    public function edit(Evaluacion $evaluacion)
    {
        $alumnos = Alumno::all();
        $cursos = Curso::all();
        return view('evaluaciones.edit', compact('evaluacion', 'alumnos', 'cursos'));
    }

    public function update(Request $request, Evaluacion $evaluacion)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'nota' => 'required|integer|min:1|max:10',
        ]);

        $evaluacion->update($request->all());
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada.');
    }

    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada.');
    }
}
