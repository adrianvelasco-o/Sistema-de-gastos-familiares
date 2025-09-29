<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\traerDatosController;

Route::get('/', function () {
    return view('Dashboard.dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/datos', [traerDatosController::class, 'traerDatos'])->name('traerDatos');