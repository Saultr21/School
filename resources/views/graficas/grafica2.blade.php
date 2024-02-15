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
        data.addColumn('string', 'Fecha');
        data.addColumn('number', 'Consumo');

        @foreach($measurements as $measurement)
            data.addRow(['{{ $measurement->fecha->toDateString() }}', {{ $measurement->consumo }}]);
        @endforeach

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
<div id="chart_div" style="width: 100%; height: 400px;"></div>
@endsection
