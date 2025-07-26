<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;

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
            'descripcion' => 'required|string|max:255',
            'nota' => 'required|integer|min:1|max:10',
            'fecha' => 'required|date',
        ]);

        Evaluacion::create($request->only([
            'alumno_id',
            'curso_id',
            'descripcion',
            'nota',
            'fecha'
        ]));

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
            'descripcion' => 'required|string|max:255',
            'nota' => 'required|integer|min:1|max:10',
            'fecha' => 'required|date',
        ]);

        $evaluacion->update($request->only([
            'alumno_id',
            'curso_id',
            'descripcion',
            'nota',
            'fecha'
        ]));

        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada.');
    }

    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada.');
    }
}
