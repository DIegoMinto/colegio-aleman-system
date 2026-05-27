<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocenteController;

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
});
