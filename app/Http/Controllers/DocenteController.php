<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|numeric|digits_between:7,8|unique:docentes,dni',
            'email' => 'required|email|unique:docentes,email',
            'fecha_nacimiento' => 'required|date|before:-18 years',
            'activo' => 'required|boolean',
        ]);

        Docente::create($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente creado correctamente.');
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|numeric|digits_between:7,8|unique:docentes,dni,' . $docente->id,
            'email' => 'required|email|unique:docentes,email,' . $docente->id,
            'fecha_nacimiento' => 'required|date|before:-18 years',
            'activo' => 'required|boolean',
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }
}
