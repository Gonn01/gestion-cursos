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
    return redirect()->route('alumnos.index'); // o la vista principal que tengas
});
Route::resource('alumnos', AlumnoController::class);
Route::resource('docentes', DocenteController::class);
Route::resource('cursos', CursoController::class);
Route::resource('inscripciones', InscripcionController::class);
Route::resource('evaluaciones', EvaluacionController::class);
Route::resource('archivos', ArchivoAdjuntoController::class);
Route::resource('usuarios', UserController::class);