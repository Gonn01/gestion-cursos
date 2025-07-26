<?php

namespace App\Http\Controllers;

use App\Models\ArchivoAdjunto;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|in:tarea,material,guía',
            'archivo' => 'required|mimes:pdf,docx,ppt,jpg,png|max:2048',
        ]);

        $filePath = $request->file('archivo')->store('archivos_adjuntos');

        ArchivoAdjunto::create([
            'curso_id' => $request->curso_id,
            'titulo' => $request->titulo,
            'archivo_url' => $filePath,
            'tipo' => $request->tipo,
            'fecha_subida' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo adjunto subido.');
    }

    public function destroy(ArchivoAdjunto $archivo)
    {
        Storage::delete($archivo->archivo_url);
        $archivo->delete();

        return redirect()->route('archivos_adjuntos.index')->with('success', 'Archivo eliminado.');
    }
}
