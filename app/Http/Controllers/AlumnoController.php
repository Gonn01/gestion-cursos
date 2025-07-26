<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    public function form(Alumno $alumno = null)
    {
        return view('alumnos.form', compact('alumno'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|numeric|digits_between:7,8|unique:alumnos,dni',
            'email' => 'required|email|unique:alumnos,email',
            'fecha_nacimiento' => 'required|date|before:-16 years',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'genero' => 'required|in:masculino,femenino,otro',
            'activo' => 'required|in:0,1',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|numeric|digits_between:7,8|unique:alumnos,dni,' . $alumno->id,
            'email' => 'required|email|unique:alumnos,email,' . $alumno->id,
            'fecha_nacimiento' => 'required|date|before:-16 years',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
            'genero' => 'required|in:masculino,femenino,otro',
            'activo' => 'required|in:0,1',
        ]);

        $alumno->update($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado.');
    }
}
