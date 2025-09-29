<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class traerDatosController extends Controller
{
    public function traerDatos(Request $request)
{
    $data = collect(explode(',', $request->datos))
        ->map(fn($item) => trim($item));

    // Frecuencia Absoluta
    $frecuenciaAbsoluta = $data->countBy();

    // Total
    $total = $data->count();

    // Frecuencia Relativa
    $frecuenciaRelativa = $frecuenciaAbsoluta->map(fn($count) => $count / $total);

    // Frecuencia Acumulada (a partir de Frecuencia Absoluta)
    $frecuenciaAcumulada = [];
    $acum = 0;
    foreach ($frecuenciaAbsoluta as $valor => $fa) {
        $acum += $fa;
        $frecuenciaAcumulada[] = $acum;
    }

    // Frecuencia Relativa Acumulada
    $frecuenciaRelativaAcumulada = [];
    $acum = 0;
    foreach ($frecuenciaRelativa as $valor => $fr) {
        $acum += $fr;
        $frecuenciaRelativaAcumulada[] = $acum;
    }

    // Porcentaje
    $porcentaje = $frecuenciaRelativa->map(fn($val) => $val * 100);

    // Construir resultado
    $resultado = collect();
    $i = 0;
    foreach ($frecuenciaAbsoluta as $key => $fa) {
        $resultado->put($key, [
            'Frecuencia Absoluta' => $fa,
            'Frecuencia Relativa' => $frecuenciaRelativa[$key],
            'Frecuencia Acumulada' => $frecuenciaAcumulada[$i],
            'Frecuencia Relativa Acumulada' => $frecuenciaRelativaAcumulada[$i],
            'Porcentaje' => $porcentaje[$key],
        ]);
        $i++;
    }

    return response()->json($resultado);
}
}
