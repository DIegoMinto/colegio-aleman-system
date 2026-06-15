<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\NoticiaController;

//RUTAS LOGIN
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');

    //RUTAS DOCENTES
    Route::get('/profesores', [DocenteController::class, 'index'])->name('profesores.index');
    Route::get('/profesores/crear', [DocenteController::class, 'create'])->name('profesores.create');
    Route::post('/profesores', [DocenteController::class, 'store'])->name('profesores.store');
    Route::get('/profesores/{docente}/editar', [DocenteController::class, 'edit'])->name('profesores.edit');
    Route::put('/profesores/{docente}', [DocenteController::class, 'update'])->name('profesores.update');
    Route::delete('/profesores/{docente}', [DocenteController::class, 'destroy'])->name('profesores.destroy');

    //RUTAS CURSOS
    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/cursos/crear', [CursoController::class, 'create'])->name('cursos.create');
    Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
    Route::get('/cursos/editar', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::get('/cursos/eliminar', [CursoController::class, 'destroy'])->name('cursos.destroy');

    //RUTAS MATERIAS
    Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias/crear', [MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{id}/editar', [MateriaController::class, 'edit'])->name('materias.edit');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('materias.destroy');

    //RUTAS ASIGNACIONES
    Route::get('/asignaciones', [AsignacionController::class, 'index'])->name('asignaciones.index');
    Route::get('/asignaciones/crear', [AsignacionController::class, 'create'])->name('asignaciones.create');
    Route::post('/asignaciones', [AsignacionController::class, 'store'])->name('asignaciones.store');
    Route::get('/asignaciones/{id}/editar', [AsignacionController::class, 'edit'])->name('asignaciones.edit');
    Route::delete('/asignaciones/{id}', [AsignacionController::class, 'destroy'])->name('asignaciones.destroy');

    //RUTAS NOTICIAS
    Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/noticias/crear', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
});
