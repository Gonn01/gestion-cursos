<?php

namespace App\Http\Controllers;

use App\Models\ArchivoAdjunto;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoAdjuntoController extends Controller
{
    public function index()
    {
        $archivos = ArchivoAdjunto::with('curso')->get();
        return view('archivos_adjuntos.index', compact('archivos'));
    }

    public function form()
    {
        $cursos = Curso::all();
        return view('archivos_adjuntos.form', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'archivo' => 'required|mimes:pdf,docx,ppt,jpg,png|max:2048',
        ]);

        $file = $request->file('archivo');
        $path = $file->store('archivos_adjuntos', 'public');


        ArchivoAdjunto::create([
            'curso_id' => $request->curso_id,
            'titulo' => $file->getClientOriginalName(),
            'archivo' => $path,
            'archivo_url' => Storage::url($path),
            'tipo' => $file->extension(),
            'fecha_subida' => now(),
        ]);


        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo subido correctamente.');
    }

    public function destroy(ArchivoAdjunto $archivo)
    {
        if ($archivo->archivo) {
            Storage::delete($archivo->archivo);
        }

        $archivo->delete();

        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo eliminado.');
    }

}
