<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('docente')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $docentes = Docente::all();
        return view('cursos.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'estado' => 'required|in:activo,finalizado,cancelado',
            'modalidad' => 'required|in:presencial,virtual,hibrido',
            'docente_id' => 'required|exists:docentes,id',
            'limite_inscriptos' => 'required|integer|min:1',
        ]);

        Curso::create($request->all());
        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    public function edit(Curso $curso)
    {
        $docentes = Docente::all();
        return view('cursos.edit', compact('curso', 'docentes'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required',
            'estado' => 'required|in:activo,finalizado,cancelado',
            'modalidad' => 'required|in:presencial,virtual,hibrido',
            'docente_id' => 'required|exists:docentes,id',
            'limite_inscriptos' => 'required|integer|min:1',
        ]);

        $curso->update($request->all());
        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
}
