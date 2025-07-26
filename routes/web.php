<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ArchivoAdjuntoController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('alumnos.index');
});

Route::get('alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('alumnos/form/{alumno?}', [AlumnoController::class, 'form'])->name('alumnos.form');
Route::post('alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
Route::put('alumnos/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');
Route::delete('alumnos/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');

Route::get('docentes', [DocenteController::class, 'index'])->name('docentes.index');
Route::get('docentes/form/{docente?}', [DocenteController::class, 'form'])->name('docentes.form');
Route::post('docentes', [DocenteController::class, 'store'])->name('docentes.store');
Route::put('docentes/{docente}', [DocenteController::class, 'update'])->name('docentes.update');
Route::delete('docentes/{docente}', [DocenteController::class, 'destroy'])->name('docentes.destroy');


Route::get('cursos', [CursoController::class, 'index'])->name('cursos.index');
Route::get('cursos/form/{curso?}', [CursoController::class, 'form'])->name('cursos.form');
Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store');
Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update');
Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy');


Route::get('inscripciones', [InscripcionController::class, 'index'])->name('inscripciones.index');
Route::get('inscripciones/form/{inscripcion?}', [InscripcionController::class, 'form'])->name('inscripciones.form');
Route::post('inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
Route::put('inscripciones/{inscripcion}', [InscripcionController::class, 'update'])->name('inscripciones.update');
Route::delete('inscripciones/{inscripcion}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy');

Route::get('evaluaciones', [EvaluacionController::class, 'index'])->name('evaluaciones.index');
Route::get('evaluaciones/form/{evaluacion?}', [EvaluacionController::class, 'form'])->name('evaluaciones.form');
Route::post('evaluaciones', [EvaluacionController::class, 'store'])->name('evaluaciones.store');
Route::put('evaluaciones/{evaluacion}', [EvaluacionController::class, 'update'])->name('evaluaciones.update');
Route::delete('evaluaciones/{evaluacion}', [EvaluacionController::class, 'destroy'])->name('evaluaciones.destroy');


Route::get('archivos_adjuntos', [ArchivoAdjuntoController::class, 'index'])->name('archivos_adjuntos.index');
Route::get('archivos_adjuntos/form', [ArchivoAdjuntoController::class, 'form'])->name('archivos_adjuntos.form');
Route::get('archivos_adjuntos/form/{archivo}', [ArchivoAdjuntoController::class, 'form'])->name('archivos_adjuntos.form.edit');
Route::post('archivos_adjuntos', [ArchivoAdjuntoController::class, 'store'])->name('archivos_adjuntos.store');
Route::put('archivos_adjuntos/{archivo}', [ArchivoAdjuntoController::class, 'update'])->name('archivos_adjuntos.update');
Route::delete('archivos_adjuntos/{archivo}', [ArchivoAdjuntoController::class, 'destroy'])->name('archivos_adjuntos.destroy');

Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/form/{usuario?}', [UserController::class, 'form'])->name('usuarios.form');
Route::post('usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::put('usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
