<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis Financiero Familiar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="display-5 text-primary">
                <i class="bi bi-graph-up"></i> Análisis Automatico de Finanzas Familiares
            </h1>
            <p class="lead">Toma el control de tus finanzas con nuestro análisis inteligente</p>
        </div>
        <!-- Explicacion para calcular -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h4 class="mb-0"><i class="bi bi-question-circle"></i> ¿Cómo calcular mis gastos correctamente?</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card h-100 border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">💰 Ingresos Totales</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Suma todos tus ingresos:</strong></p>
                                <ul class="small">
                                    <li>Salarios fijos</li>
                                    <li>Ingresos extra</li>
                                    <li>Pensiones</li>
                                    <li>Alquileres</li>
                                    <li>Bonificaciones</li>
                                    <li>Negocios</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">🏠 Gastos Fijos (Obligatorios)</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Gastos que no cambian:</strong></p>
                                <ul class="small">
                                    <li><strong>Arriendo/Hipoteca:</strong> Pago de vivienda</li>
                                    <li><strong>Servicios:</strong> Luz, agua, gas, internet</li>
                                    <li><strong>Transporte:</strong> Gasolina, pasajes</li>
                                    <li><strong>Seguros:</strong> Salud, auto, vida</li>
                                    <li><strong>Educación:</strong> Colegio, universidad</li>
                                    <li><strong>Créditos:</strong> Tarjetas, préstamos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">🎯 Gastos Dinámicos (Variables)</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>Gastos que cambian cada mes:</strong></p>
                                <ul class="small">
                                    <li><strong>Alimentación:</strong> Supermercado, mercado</li>
                                    <li><strong>Entretenimiento:</strong> Cine, restaurantes</li>
                                    <li><strong>Ropa:</strong> Prendas, calzado</li>
                                    <li><strong>Salud:</strong> Medicinas, consultas</li>
                                    <li><strong>Hogar:</strong> Mantenimiento, decoración</li>
                                    <li><strong>Imprevistos:</strong> Reparaciones, emergencias</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resultados del Análisis, estos solo se muestra cuando hay datos -->
        @if($promIngreso > 0)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-speedometer2"></i> Resultados del Análisis</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Ingreso Promedio</div>
                            <div class="card-body">
                                <h5 class="card-title">${{ number_format($promIngreso, 2) }}</h5>
                                <p class="card-text">Promedio mensual de ingresos familiares</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Promedio Gastos Fijos</div>
                            <div class="card-body">
                                <h5 class="card-title">${{ number_format($promFijos, 2) }}</h5>
                                <p class="card-text">Promedio de gastos obligatorios mensuales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Saldo Disponible</div>
                            <div class="card-body">
                                <h5 class="card-title">${{ number_format($saldo, 2) }}</h5>
                                <p class="card-text">Dinero para ahorrar o invertir cada mes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medidas de tendencia central -->
                <h5 class="mt-4">📌 Medidas de Tendencia Central</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Media Ingresos
                                <button type="button"
                                        class="btn btn-link p-0 ms-2 text-muted"
                                        style="float: right;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#formulaMedia">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </td>
                            <td>${{ number_format($promIngreso, 2) }}</td>
                            <td>Ingreso mensual promedio</td>
                        </tr>
                        <tr>
                            <td>Media Gastos Fijos</td>
                            <td>${{ number_format($promFijos, 2) }}</td>
                            <td>Promedio de gastos obligatorios</td>
                        </tr>
                        <tr>
                            <td>Media Gastos Dinámicos</td>
                            <td>${{ number_format($promDinamicos, 2) }}</td>
                            <td>Promedio de gastos variables</td>
                        </tr>
                        <tr>
                            <td>Mediana Ingresos</td>
                            <td>${{ number_format($medianaIngresos, 2) }}</td>
                            <td>Valor central de ingresos mensuales</td>
                        </tr>
                        <tr>
                            <td>Mediana Gastos Fijos</td>
                            <td>${{ number_format($medianaFijos, 2) }}</td>
                            <td>Valor central de gastos fijos</td>
                        </tr>
                        <tr>
                            <td>Mediana Gastos Dinámicos
                                <button type="button" class="btn btn-link p-0 ms-2 text-muted" style="float:right;" data-bs-toggle="modal" data-bs-target="#formulaMediana">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </td>
                            <td>{{ number_format($medianaDinamicos, 2) }}</td>
                            <td>Valor central de los datos ordenados</td>
                        </tr>
                        <tr>
                            <td>Moda Gastos Dinámicos
                                <button type="button" class="btn btn-link p-0 ms-2 text-muted" style="float:right;" data-bs-toggle="modal" data-bs-target="#formulaModa">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </td>
                            <td>{{ $moda ?? 'N/A' }}</td>
                            <td>Valor que más se repite en gastos variables</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Medidas de dispersion -->
                <h5 class="mt-4">📌 Medidas de Dispersión</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Interpretación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Desviación Estándar Gastos Dinámicos
                                <button type="button" class="btn btn-link p-0 ms-2 text-muted" style="float:right;" data-bs-toggle="modal" data-bs-target="#formulaDesviacion">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </td>
                            <td>{{ number_format($desviacion, 2) }}</td>
                            <td>Variabilidad de tus gastos dinámicos</td>
                        </tr>
                        <tr>
                            <td>Desviación Estándar Ingresos</td>
                            <td>{{ number_format($desviacionIngresos, 2) }}</td>
                            <td>Variabilidad de tus ingresos mensuales</td>
                        </tr>
                        <tr>
                            <td>Coeficiente Variación Ingresos</td>
                            <td>{{ number_format($cvIngresos, 2) }}%</td>
                            <td>Variabilidad relativa de ingresos</td>
                        </tr>
                        <tr>
                            <td>Coeficiente Variación Gastos Dinámicos</td>
                            <td>{{ number_format($cvGastosDinamicos, 2) }}%</td>
                            <td>Variabilidad relativa de gastos variables</td>
                        </tr>
                        <tr>
                            <td>Rango Ingresos</td>
                            <td>{{ number_format($rangoIngresos, 2) }}</td>
                            <td>Diferencia entre mayor y menor ingreso</td>
                        </tr>
                        <tr>
                            <td>Rango Gastos Fijos</td>
                            <td>{{ number_format($rangoFijos, 2) }}</td>
                            <td>Diferencia entre mayor y menor gasto fijo</td>
                        </tr>
                        <tr>
                            <td>Rango Gastos Dinámicos</td>
                            <td>{{ number_format($rangoDinamicos, 2) }}</td>
                            <td>Diferencia entre mayor y menor gasto variable</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Indicadores financieros -->
                <h5 class="mt-4">📌 Indicadores Financieros</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Indicador</th>
                            <th>Valor</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>% Gastos Fijos</td>
                            <td>{{ number_format($porcFijos, 2) }}%</td>
                            <td>Porcentaje de ingresos para gastos fijos</td>
                        </tr>
                        <tr>
                            <td>% Gastos Dinámicos</td>
                            <td>{{ number_format($porcDinamicos, 2) }}%</td>
                            <td>Porcentaje para gastos variables</td>
                        </tr>
                        <tr>
                            <td>Saldo Disponible</td>
                            <td>${{ number_format($saldo, 2) }}</td>
                            <td>Dinero restante después de gastos</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Graficos -->
                <h5 class="mt-4">📊 Visualización de Datos</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Distribución de Gastos</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="gastosChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Ingresos vs Gastos</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="ingresosVsGastos"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conclusiones automaticas -->
                @if(count($conclusion) > 0)
                <div class="mt-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">💡 Conclusiones Automáticas</h5>
                        </div>
                        <div class="card-body">
                            @foreach($conclusion as $mensaje)
                                <p class="card-text mb-2">{!! $mensaje !!}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Proyección Anual -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#proyeccionAnual" aria-expanded="false" aria-controls="proyeccionAnual">
                                📆 Adicionalmente puedes ver tu proyección Anual, dando clic aqui!
                            </button>
                        </h5>
                    </div>
                    <div id="proyeccionAnual" class="collapse">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ingresos Anuales</td>
                                        <td>${{ number_format($ingresoAnual, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos Fijos Anuales</td>
                                        <td>${{ number_format($gastosFijosAnual, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gastos Dinámicos Anuales</td>
                                        <td>${{ number_format($gastosDinamicosAnual, 2) }}</td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Saldo Anual</strong></td>
                                        <td><strong>${{ number_format($saldoAnual, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals para las formulas -->
        <!-- Modal Media -->
        <div class="modal fade" id="formulaMedia" tabindex="-1">
            <div class="modal-dialog"><div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Fórmula de la Media</h5></div>
                <div class="modal-body">
                    <p><strong>Media (promedio):</strong></p>
                    <p class="text-center">μ = (Σx) / n</p>
                    <p>Σx = suma de todos los valores<br>n = número de datos</p>
                </div>
            </div></div>
        </div>

        <!-- Modal Mediana -->
        <div class="modal fade" id="formulaMediana" tabindex="-1">
            <div class="modal-dialog"><div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Fórmula de la Mediana</h5></div>
                <div class="modal-body">
                    <p><strong>Mediana:</strong></p>
                    <p class="text-center">
                        Si n es impar → valor central<br>
                        Si n es par → (x<sub>n/2</sub> + x<sub>n/2+1</sub>) / 2
                    </p>
                </div>
            </div></div>
        </div>

        <!-- Modal Moda -->
        <div class="modal fade" id="formulaModa" tabindex="-1">
            <div class="modal-dialog"><div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Fórmula de la Moda</h5></div>
                <div class="modal-body">
                    <p><strong>Moda:</strong></p>
                    <p class="text-center">Valor que más veces se repite</p>
                </div>
            </div></div>
        </div>

        <!-- Modal Desviación estándar -->
        <div class="modal fade" id="formulaDesviacion" tabindex="-1">
            <div class="modal-dialog"><div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Fórmula de la Desviación Estándar</h5></div>
                <div class="modal-body">
                    <p><strong>Desviación Estándar:</strong></p>
                    <p class="text-center">
                        σ = √( Σ (xᵢ - μ)² / n )
                    </p>
                    <p>Indica qué tan dispersos están los datos respecto a la media.</p>
                </div>
            </div></div>
        </div>

        @else
        <!-- Mensaje de bienvenida cuando no hay datos -->
        <div class="alert alert-info text-center">
            <h4><i class="bi bi-graph-up"></i> ¡Bienvenido a tu Análisis Financiero!</h4>
            <p class="mb-0">Comienza ingresando tus datos financieros en el formulario below para obtener un análisis completo de tus finanzas.</p>
        </div>
        @endif

        <!-- Formularios de Entrada de Datos -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-cloud-upload"></i> Ingresar Datos Financieros</h4>
            </div>
            <div class="card-body">
                <!-- Formulario manual -->
                <form action="{{ route('analisis.calcular') }}" method="POST" class="mb-4">
                    @csrf
                   
                    <div class="alert alert-info">
                        <h5><i class="bi bi-info-circle"></i> ¿Cómo funciona?</h5>
                        <p class="mb-1">Ingresa tus datos financieros de los últimos meses. Cuantos más meses ingreses, más preciso será el análisis.</p>
                    </div>

                    <div class="row">
                        <!-- Ingresos -->
                        <div class="col-md-4">
                            <div class="card h-100 border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">💰 Ingresos Mensuales</h6>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted">
                                        <i class="bi bi-lightbulb"></i>
                                        <strong>Ejemplos:</strong><br>
                                        • Salario: $2,500<br>
                                        • Ingresos extra: $300<br>
                                        • <strong>Total mensual: $2,800</strong>
                                    </p>
                                    <div id="ingresos-container">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="ingresos[]" class="form-control" placeholder="Ej: 2800" step="0.01" min="0" required>
                                            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">×</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="addField('ingresos-container')">
                                        <i class="bi bi-plus-circle"></i> Agregar Otro Mes
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Gastos Fijos -->
                        <div class="col-md-4">
                            <div class="card h-100 border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0">🏠 Gastos Fijos</h6>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted">
                                        <i class="bi bi-lightbulb"></i>
                                        <strong>Gastos obligatorios:</strong><br>
                                        • Arriendo: $500<br>
                                        • Servicios: $200<br>
                                        • Transporte: $150<br>
                                        • <strong>Total fijos: $850</strong>
                                    </p>
                                    <div id="fijos-container">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="gastos_fijos[]" class="form-control" placeholder="Ej: 850" step="0.01" min="0" required>
                                            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">×</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="addField('fijos-container')">
                                        <i class="bi bi-plus-circle"></i> Agregar Otro Mes
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Gastos Dinamicos -->
                        <div class="col-md-4">
                            <div class="card h-100 border-info">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">🎯 Gastos Dinámicos</h6>
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted">
                                        <i class="bi bi-lightbulb"></i>
                                        <strong>Gastos variables:</strong><br>
                                        • Mercado: $400<br>
                                        • Entretenimiento: $100<br>
                                        • Ropa: $50<br>
                                        • <strong>Total variables: $550</strong>
                                    </p>
                                    <div id="dinamicos-container">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="gastos_dinamicos[]" class="form-control" placeholder="Ej: 550" step="0.01" min="0" required>
                                            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">×</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-info" onclick="addField('dinamicos-container')">
                                        <i class="bi bi-plus-circle"></i> Agregar Otro Mes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-calculator"></i> Calcular Análisis Financiero
                        </button>
                    </div>
                </form>

                <!-- Importar CSV -->
                <div class="border-top pt-4">
                    <div class="alert alert-secondary">
                        <h5><i class="bi bi-file-earmark-spreadsheet"></i> ¿Prefieres usar Excel/CSV?</h5>
                        <p class="mb-2">Descarga nuestra plantilla o usa tu propio archivo CSV con el siguiente formato:</p>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('analisis.importar.csv') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="archivo_csv" class="form-control" accept=".csv,.txt" required>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-upload"></i> Importar CSV
                                    </button>
                                </div>
                                <small class="form-text text-muted">
                                    Formato: Tres columnas (ingresos, gastos_fijos, gastos_dinamicos)
                                </small>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6>📋 Formato del CSV:</h6>
                                    <code class="small d-block p-2 bg-light rounded">
                                        ingresos,gastos_fijos,gastos_dinamicos<br>
                                        2800,850,550<br>
                                        3000,900,600<br>
                                        2750,800,500
                                    </code>
                                    <button type="button" class="btn btn-outline-success btn-sm mt-2" onclick="descargarPlantilla()">
                                        <i class="bi bi-download"></i> Descargar Plantilla CSV
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    @if($promIngreso > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de pastel: Gastos fijos vs dinámicos
        var ctx1 = document.getElementById('gastosChart').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Gastos Fijos', 'Gastos Dinámicos'],
                datasets: [{
                    data: [{{ $promFijos }}, {{ $promDinamicos }}],
                    backgroundColor: ['#007bff', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gráfico de barras: Ingresos vs Gastos
        var ctx2 = document.getElementById('ingresosVsGastos').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Ingresos', 'Gastos Fijos', 'Gastos Dinámicos'],
                datasets: [{
                    label: 'Monto ($)',
                    data: [{{ $promIngreso }}, {{ $promFijos }}, {{ $promDinamicos }}],
                    backgroundColor: ['#28a745', '#007bff', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endif

    <!-- JavaScript adicional para cambios dinamicos -->
    <script>
    function addField(containerId) {
        const container = document.getElementById(containerId);
        const newField = document.createElement('div');
        newField.className = 'input-group mb-2';
        newField.innerHTML = `
            <span class="input-group-text">$</span>
            <input type="number" name="${containerId.replace('-container', '')}[]" class="form-control" placeholder="Monto del mes" step="0.01" min="0" required>
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">×</button>
        `;
        container.appendChild(newField);
    }

    function removeField(button) {
        if (document.querySelectorAll('#ingresos-container .input-group').length > 1 ||
            document.querySelectorAll('#fijos-container .input-group').length > 1 ||
            document.querySelectorAll('#dinamicos-container .input-group').length > 1) {
            button.closest('.input-group').remove();
        }
    }

    // Descargar plantilla CSV
    function descargarPlantilla() {
        const contenido = `ingresos,gastos_fijos,gastos_dinamicos\n2800,850,550\n3000,900,600\n2750,800,500`;
        const blob = new Blob([contenido], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'plantilla-finanzas-familiares.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
       
        alert('Plantilla descargada. Ábrela con Excel y completa con tus datos.');
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>