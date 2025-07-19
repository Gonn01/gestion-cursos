<?php

namespace App\Http\Controllers;

use App\Models\ArchivoAdjunto;
use Illuminate\Http\Request;

class ArchivoAdjuntoController extends Controller
{
    public function index()
    {
        $archivos = ArchivoAdjunto::with('curso')->get();
        return view('archivos_adjuntos.index', compact('archivos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('archivos_adjuntos.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'archivo' => 'required|mimes:pdf,docx,ppt,jpg,png|max:2048',
        ]);

        $file = $request->file('archivo')->store('archivos_adjuntos');

        ArchivoAdjunto::create([
            'curso_id' => $request->curso_id,
            'archivo' => $file,
            'tipo' => $request->file('archivo')->extension(),
        ]);

        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo adjunto subido.');
    }

    public function destroy(ArchivoAdjunto $archivo)
    {
        \Storage::delete($archivo->archivo);
        $archivo->delete();

        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo eliminado.');
    }
}
