<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\traerDatosController;
use App\Http\Controllers\AnalisisController;

Route::get('/', function () {
    return view('Dashboard.dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/datos', [traerDatosController::class, 'traerDatos'])->name('traerDatos');

Route::get('/analisis', [AnalisisController::class, 'index'])->name('analisis.index');
Route::post('/analizar', [AnalisisController::class, 'analizar'])->name('analisis.calcular');
Route::post('/importar-csv', [AnalisisController::class, 'importarCSV'])->name('analisis.importar.csv');