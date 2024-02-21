@extends('layouts.grafica')

@section('title', $title)


@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // Datos para el sensor 1
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Hora');
        data1.addColumn('number', 'Luz');
        var measurements_id_1 = {!! json_encode($measurements_id_1) !!};
        for (var i = 0; i < measurements_id_1.length; i++) {
            data1.addRow([measurements_id_1[i].hour, measurements_id_1[i].consumo_diferencia]);
        }

        // Configuración para el gráfico del sensor 1
        var options1 = {

            curveType: 'function',
            colors: ['#3366cc']
        };

        var chart1 = new google.visualization.AreaChart(document.getElementById('chart_div_agua'));
        chart1.draw(data1, options1);

        // Datos para el sensor 2
        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Hora');
        data2.addColumn('number', 'Agua');
        var measurements_id_2 = {!! json_encode($measurements_id_2) !!};
        for (var j = 0; j < measurements_id_2.length; j++) {
            data2.addRow([measurements_id_2[j].hour, measurements_id_2[j].consumo_diferencia]);
        }

        // Configuración para el gráfico del sensor 2
        var options2 = {

            curveType: 'function',
            colors: ['#dc3912']

        };

        var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div_luz'));
        chart2.draw(data2, options2);
    }
</script>

@endsection

@section('content')
<div class="d-flex justify-content-center border">
    <div id="chart_div_agua" style="width: 90%; height: 400px;"></div>
</div>
<div class="d-flex justify-content-center border">
    <div id="chart_div_luz" style="width: 90%; height: 400px;"></div>
</div>
@endsection
