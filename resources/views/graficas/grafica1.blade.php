@extends('layouts.grafica')

@section('title', $title)
@section('subtitle', $subtitle)

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Fecha');
        data.addColumn('number', 'Consumo'); 

        // Procesar los datos
        var processedData = [];
        @foreach($measurements as $measurement)
            processedData.push([new Date('{{ $measurement->fecha }}'), {{ $measurement->consumo }}]);
        @endforeach
        data.addRows(processedData);
        var options = {
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection

@section('content')
<div id="chart_div" style="width: 100%; height: 400px;"></div>
@endsection



