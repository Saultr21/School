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
        data.addColumn('number', 'Consumo Luz');

        var processedDataAgua = [];
        var processedDataLuz = [];
        var processedDataAgua = {{ $measurementAguaAnterior->consumo }};
        var processedDataLuz = {{ $measurementLuzAnterior->consumo }};

        @foreach($measurementsAgua as $measurement)
            processedDataAgua.push(['{{ $measurement->fecha }}', {{ $measurement->consumo }}]);
        @endforeach

        @foreach($measurementsLuz as $measurement)
            processedDataLuz.push(['{{ $measurement->fecha }}', {{ $measurement->consumo }}]);
        @endforeach

        var mergedData = [];

        // Fusionar los datos de agua y luz
        for (var i = 0; i < processedDataAgua.length; i++) {
            var date = processedDataAgua[i][0];
            var consumoAgua = processedDataAgua[i][1];
            var consumoLuz = processedDataLuz[i][1];
            mergedData.push([date, consumoAgua, consumoLuz]);
        }

        data.addRows(mergedData); // Agregar los datos fusionados al DataTable

        var options = {
            title: '{{ $title }}',
            subtitle: '{{ $subtitle }}',
            hAxis: {
                title: 'Fecha'
            },
            vAxis: {
                title: 'Consumo'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

@endsection

@section('content')
<div>{{$endOfMonth2}}</div>
<div>{{ $measurementAguaAnterior->consumo }}</div>
<div>{{$measurementLuzAnterior->consumo}}</div>
<div id="chart_div" style="width: 100%; height: 400px;"></div>
@endsection
