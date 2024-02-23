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

        var indiceActual = 2; // Índice de la vista actual

        function alternarVistas() {
            // Obtener la próxima vista del arreglo
            var proximaVista = vistas[indiceActual+1];
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
        data.addColumn('number', 'Consumo Luz');

        var processedDataLuz = [];

        @foreach($measurementsLuz as $measurement)
            var formattedDate = new Date('{{ $measurement->fecha }}');
            var dayMonthString = (formattedDate.getMonth() + 1) + '/' + formattedDate.getDate(); // Formato MM/DD

            processedDataLuz.push([dayMonthString, {{ $measurement->consumo }}]);
        @endforeach

        var mergedData = [];
        var valor = {{$measurementLuzAnterior->consumo}};
        let ultimo_consumo = 0;

        // Fusionar los datos de agua y luz
        for (var i = 0; i < processedDataLuz.length; i++) {
            var date = processedDataLuz[i][0];
            var consumoLuz = processedDataLuz[i][1]-ultimo_consumo;
            ultimo_consumo = consumoLuz;
            mergedData.push([date, consumoLuz]);
        }

        data.addRows(mergedData); // Agregar los datos fusionados al DataTable

        var options = {

        curveType: 'function',
        colors: ['#dc3912'],
        backgroundColor: 'transparent',
        animation: {
        startup: true, // Activar la animación al inicio
        duration: 1000, // Duración de la animación en milisegundos (1 segundo en este caso)
        easing: 'out' // Tipo de suavizado de la animación
        }
    }

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

@endsection

@section('content')
<div id="chart_div" style="width: 100%; height: 400px;"></div>
@endsection
