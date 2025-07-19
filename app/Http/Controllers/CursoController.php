<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
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
        $docentes = Docente::where('activo', true)->get();
        return view('cursos.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'modalidad' => 'required|in:presencial,virtual,hibrido',
            'aula_virtual' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'cupo_maximo' => 'required|integer|min:1',
            'docente_id' => 'required|exists:docentes,id',
        ]);

        // Si es virtual o híbrido, aula_virtual es obligatorio
        if (in_array($request->modalidad, ['virtual', 'hibrido']) && empty($request->aula_virtual)) {
            return back()->withErrors(['aula_virtual' => 'El campo aula virtual es obligatorio en modalidad virtual o híbrida.'])->withInput();
        }

        // Docente no puede tener más de 3 cursos activos
        $cursosActivos = Curso::where('docente_id', $request->docente_id)->where('activo', true)->count();
        if ($cursosActivos >= 3) {
            return back()->withErrors(['docente_id' => 'El docente ya tiene 3 cursos activos.'])->withInput();
        }

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso creado con éxito.');
    }

    public function edit(Curso $curso)
    {
        $docentes = Docente::where('activo', true)->get();
        return view('cursos.edit', compact('curso', 'docentes'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'modalidad' => 'required|in:presencial,virtual,hibrido',
            'aula_virtual' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'cupo_maximo' => 'required|integer|min:1',
            'docente_id' => 'required|exists:docentes,id',
        ]);

        if (in_array($request->modalidad, ['virtual', 'hibrido']) && empty($request->aula_virtual)) {
            return back()->withErrors(['aula_virtual' => 'El campo aula virtual es obligatorio.'])->withInput();
        }

        $curso->update($request->all());

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado con éxito.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
}
