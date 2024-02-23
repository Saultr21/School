@extends('layouts.grafica')

@section('title', $title)
@section('subtitle', $subtitle)

@section('scripts')

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        // Arreglo con las rutas de las vistas
        var vistas = [
            "{{ route('grafica1') }}",
            "{{ route('grafica2') }}",
            "{{ route('grafica3') }}",
            "{{ route('grafica4') }}",
        ];

        var indiceActual = 3; // Índice de la vista actual

        function alternarVistas() {
            // Obtener la próxima vista del arreglo
            var proximaVista = vistas[indiceActual-3];
            // Redirigir a la próxima vista
            window.location.href = proximaVista;
        }

        setInterval(alternarVistas, 5000); // 10000 ms = 10 segundos
    });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Fecha');
        data.addColumn('number', 'Consumo Agua');

        var processedDataAgua = [];
        var valor = {{$measurementAguaAnterior->consumo}};
        let ultimo_consumo = valor;

        @foreach($measurementsAgua as $measurement)
            var formattedDate = new Date('{{ $measurement->fecha }}');
            var dayMonthString = (formattedDate.getMonth() + 1) + '/' + formattedDate.getDate(); // Formato MM/DD

            processedDataAgua.push([dayMonthString, {{ $measurement->consumo }}]);
        @endforeach

        var mergedData = [];

        // Fusionar los datos de agua y luz
        for (var i = 0; i < processedDataAgua.length; i++) {
            var date = processedDataAgua[i][0];
            var consumoAgua = processedDataAgua[i][1]-ultimo_consumo;
            ultimo_consumo = consumoAgua;
            mergedData.push([date, consumoAgua]);
        }

        data.addRows(mergedData); // Agregar los datos fusionados al DataTable

        var options = {
            curveType: 'function',
            colors: ['#3366CC'],
            backgroundColor: 'transparent',
            animation: {
                startup: true, // Activar la animación al inicio
                duration: 1000, // Duración de la animación en milisegundos (1 segundo en este caso)
                easing: 'out' // Tipo de suavizado de la animación
            },

        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

@endsection

@section('content')
<div id="chart_div" style="width: 100%; height: 400px;"></div>
@endsection
