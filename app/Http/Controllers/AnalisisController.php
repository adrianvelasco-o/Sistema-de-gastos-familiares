<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Gasto;
use Illuminate\Support\Facades\DB;


class AnalisisController extends Controller
{
    public function index()
    {
        // Aqui se inicializan variables 
        return view('Dashboard.analisis', [
            'promIngreso' => 0,
            'promFijos' => 0,
            'promDinamicos' => 0,
            'desviacion' => 0,
            'porcFijos' => 0,
            'porcDinamicos' => 0,
            'saldo' => 0,
            'moda' => 'N/A',
            'ingresos' => [],
            'gastosFijos' => [],
            'gastosDinamicos' => [],
            'conclusion' => [],
            'desviacionIngresos' => 0,
            'medianaIngresos' => 0,
            'medianaFijos' => 0,
            'cvIngresos' => 0,
            'cvGastosDinamicos' => 0,
            'rangoIngresos' => 0,
            'rangoFijos' => 0,
            'rangoDinamicos' => 0,
            'ingresoAnual' => 0,
            'gastosFijosAnual' => 0,
            'gastosDinamicosAnual' => 0,
            'saldoAnual' => 0,
            'medianaDinamicos' => 0
        ]);
    }

    public function analizar(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'ingresos' => 'required|array|min:1',
            'ingresos.*' => 'required|numeric|min:0',
            'gastos_fijos' => 'required|array|min:1',
            'gastos_fijos.*' => 'required|numeric|min:0',
            'gastos_dinamicos' => 'required|array|min:1',
            'gastos_dinamicos.*' => 'required|numeric|min:0'
        ]);

        // Datos para el formulario
        $ingresos = $request->ingresos;
        $gastosFijos = $request->gastos_fijos;
        $gastosDinamicos = $request->gastos_dinamicos;
        return $this->procesarDatos($ingresos, $gastosFijos, $gastosDinamicos);
    }

    public function importarCSV(Request $request)
    {
        $request->validate([
            'archivo_csv' => 'required|file|mimes:csv,txt'
        ]);

        try {
            $file = $request->file('archivo_csv');
            $contenido = file($file->getPathname());
           
            $ingresos = [];
            $gastosFijos = [];
            $gastosDinamicos = [];
            
            foreach ($contenido as $numeroLinea => $linea) {
                if (trim($linea) === '') continue;
               
                if (strpos($linea, ';') !== false) {
                    $datos = str_getcsv($linea, ';');
                } else {
                    $datos = str_getcsv($linea, ',');
                }
               
                if ($numeroLinea === 0 && !is_numeric(trim($datos[0]))) {
                    continue;
                }
               
                if (count($datos) >= 3 &&
                    is_numeric(trim($datos[0])) &&
                    is_numeric(trim($datos[1])) &&
                    is_numeric(trim($datos[2]))) {
                   
                    $ingresos[] = floatval(trim($datos[0]));
                    $gastosFijos[] = floatval(trim($datos[1]));
                    $gastosDinamicos[] = floatval(trim($datos[2]));
                }
            }

            if (empty($ingresos)) {
                return back()->with('error',
                    'No se pudieron leer los datos. Verifica que el archivo CSV tenga el formato correcto:'
                    . '<br>• Tres columnas: ingresos, gastos_fijos, gastos_dinamicos'
                    . '<br>• Valores numéricos separados por comas'
                    . '<br>Ejemplo: <code>2500,1200,800</code>'
                );
            }

            return $this->procesarDatos($ingresos, $gastosFijos, $gastosDinamicos)
                ->with('success', 'Archivo CSV procesado correctamente. Se analizaron ' . count($ingresos) . ' registros.');
                
        } catch (\Exception $e) {
            return back()->with('error',
                'Error al procesar el archivo: ' . $e->getMessage()
            );
        }
    }

    private function procesarDatos($ingresos, $gastosFijos, $gastosDinamicos)
    {
        // Medidas de tendencia central y dispersion 
       
        // Promedios
        $promIngreso = array_sum($ingresos) / count($ingresos);
        $promFijos = array_sum($gastosFijos) / count($gastosFijos);
        $promDinamicos = array_sum($gastosDinamicos) / count($gastosDinamicos);
       
        // Desviación estandar gastos dinamicos
        $media = $promDinamicos;
        $suma = 0;
        foreach ($gastosDinamicos as $g) {
            $suma += pow(($g - $media), 2);
        }
        $desviacion = sqrt($suma / count($gastosDinamicos));
        
        // Desviacion estandar de ingresos
        $sumaIngresos = 0;
        foreach ($ingresos as $ingreso) {
            $sumaIngresos += pow(($ingreso - $promIngreso), 2);
        }
        $desviacionIngresos = sqrt($sumaIngresos / count($ingresos));
        
        // Mediana para todos los grupos
        $medianaIngresos = $this->calcularMediana($ingresos);
        $medianaFijos = $this->calcularMediana($gastosFijos);
        $medianaDinamicos = $this->calcularMediana($gastosDinamicos);
        
        // Coeficiente de variacion
        $cvIngresos = ($desviacionIngresos / $promIngreso) * 100;
        $cvGastosDinamicos = ($desviacion / $promDinamicos) * 100;
        
        // Rango para todos los grupos
        $rangoIngresos = max($ingresos) - min($ingresos);
        $rangoFijos = max($gastosFijos) - min($gastosFijos);
        $rangoDinamicos = max($gastosDinamicos) - min($gastosDinamicos);

        // Indicadores financieros 
        $totalGastos = $promFijos + $promDinamicos;
        $porcFijos = ($promFijos / $promIngreso) * 100;
        $porcDinamicos = ($promDinamicos / $promIngreso) * 100;
        $saldo = $promIngreso - $totalGastos;
        
        $ingresoAnual = $promIngreso * 12;
        $gastosFijosAnual = $promFijos * 12;
        $gastosDinamicosAnual = $promDinamicos * 12;
        $saldoAnual = $saldo * 12;

        // Moda de gastos dinamicos
        $frecuencias = array_count_values(array_map('strval', $gastosDinamicos));
        arsort($frecuencias);
        $moda = floatval(key($frecuencias));

        // Conclusiones
        $conclusion = $this->generarConclusion($saldo, $porcFijos, $desviacion, $cvIngresos, $cvGastosDinamicos);

        return view('Dashboard.analisis', compact(
            'promIngreso',
            'promFijos',
            'promDinamicos',
            'desviacion',
            'porcFijos',
            'porcDinamicos',
            'saldo',
            'moda',
            'conclusion',
            'ingresos',
            'gastosFijos',
            'gastosDinamicos',
            'ingresoAnual',
            'gastosFijosAnual',
            'gastosDinamicosAnual',
            'saldoAnual',
            'medianaDinamicos',
            'rangoDinamicos',
            'desviacionIngresos',
            'medianaIngresos',
            'medianaFijos',
            'cvIngresos',
            'cvGastosDinamicos',
            'rangoIngresos',
            'rangoFijos'
        ));
    }

   
     // Calcula la mediana de un array de numeros
     
    private function calcularMediana($array) {
        if (empty($array)) {
            return 0;
        }
        
        $sorted = $array;
        sort($sorted);
        $count = count($sorted);
        
        if ($count % 2 == 0) {
            // Par: promedio de los dos valores centrales
            return ($sorted[$count/2 - 1] + $sorted[$count/2]) / 2;
        } else {
            // Impar: valor central
            return $sorted[floor($count/2)];
        }
    }

    
      // Genera conclusiones basadas en los indicadores financieros
    
    private function generarConclusion($saldo, $porcFijos, $desviacion, $cvIngresos, $cvGastosDinamicos)
    {
        $conclusiones = [];
        
        // Conclusiones sobre saldo disponible
        if ($saldo > 0) {
            $conclusiones[] = "✅ <strong>Tienes capacidad de ahorro/inversión</strong>. Saldo disponible: $" . number_format($saldo, 2);
        } else if ($saldo < 0) {
            $conclusiones[] = "❌ <strong>Gastas más de lo que ganas</strong>. Recomendamos revisar tus gastos.";
        } else {
            $conclusiones[] = "⚠️ <strong>Estás en equilibrio</strong>. No hay saldo disponible para ahorrar.";
        }

        // Conclusiones sobre gastos fijos
        if ($porcFijos > 50) {
            $conclusiones[] = "📊 <strong>Tus gastos fijos son altos</strong> (" . number_format($porcFijos, 1) . "%). Considera reducirlos.";
        } else if ($porcFijos < 30) {
            $conclusiones[] = "💰 <strong>Tus gastos fijos son bajos</strong> (" . number_format($porcFijos, 1) . "%). Buena gestión.";
        }

        // Nuevas conclusiones
        if ($cvIngresos > 20) {
            $conclusiones[] = "📈 <strong>Tus ingresos son variables</strong> (CV: " . number_format($cvIngresos, 1) . "%). Considera fuentes de ingreso estables.";
        } else if ($cvIngresos < 10) {
            $conclusiones[] = "💪 <strong>Tus ingresos son estables</strong> (CV: " . number_format($cvIngresos, 1) . "%). Excelente predictibilidad.";
        }
        
        if ($cvGastosDinamicos > 25) {
            $conclusiones[] = "🎯 <strong>Tus gastos dinámicos son muy variables</strong> (CV: " . number_format($cvGastosDinamicos, 1) . "%). Intenta estabilizarlos.";
        } else if ($cvGastosDinamicos < 15) {
            $conclusiones[] = "📋 <strong>Buen control de gastos variables</strong> (CV: " . number_format($cvGastosDinamicos, 1) . "%).";
        }
        
        // Conclusiones combinadas
        if ($cvIngresos < 10 && $cvGastosDinamicos < 15) {
            $conclusiones[] = "🏆 <strong>Excelente estabilidad financiera</strong>. Tus ingresos y gastos son predecibles.";
        }

        if ($saldo > 0 && $porcFijos < 40 && $cvIngresos < 15) {
            $conclusiones[] = "🌟 <strong>Situación financiera óptima</strong>. Tienes control total sobre tus finanzas.";
        }

        return $conclusiones;
    }
}