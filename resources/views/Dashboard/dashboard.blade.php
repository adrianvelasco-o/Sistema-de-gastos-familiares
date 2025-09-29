<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="{{ asset('js/traerDatos.js') }}"></script>
</head>
<body>

    <form class="colorful-form">
        <div class="form-group">
            <label class="form-label" for="datos">Digite los datos: separados por comas</label>
            <textarea required="" placeholder="Ingresar datos" class="form-input" name="datos" id="datos">1,2,3,4,5</textarea>
        </div>
        <button class="form-button" id="procesar">Procesar</button>
    </form>

    <div>
        <div>
            Tabla de frecuencias
        </div>
        <table class="tabla-frecuencias">
            <thead>
                <tr>
                    <th>Dato</th>
                    <th>Frecuencia</th>
                    <th>Frecuencia Relativa</th>
                    <th>Frecuencia Acumulada</th>
                    <th>Frecuencia Relativa Acumulada</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody id="tabla-frecuencias">

            </tbody>
        </table>
    </div>

    <div style="width: 25%; float:left;">
        <canvas id="barChart"></canvas>
    </div>
    <div style="width: 25%; float:right;">
        <canvas id="pieChart"></canvas>
    </div>



</body>
</html>