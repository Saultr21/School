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

        var indiceActual = 0; // Índice de la vista actual

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
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // Datos para el sensor 1
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Hora');
        data1.addColumn('number', 'Luz');
        var measurements_id_1 = {!! json_encode($measurements_id_1) !!};
        
        // Eliminar el primer elemento del array measurements_id_1
        measurements_id_1.shift();
        
        for (var j = 0; j < measurements_id_1.length; j++) {
            data1.addRow([measurements_id_1[j].hour, measurements_id_1[j].consumo_diferencia]);
        }

        // Configuración para el gráfico del sensor 1
        var options1 = {
            curveType: 'function',
            colors: ['#3366CC'],
            backgroundColor: 'transparent',
            animation: {
                startup: true, // Activar la animación al inicio
                duration: 1000, // Duración de la animación en milisegundos (1 segundo en este caso)
                easing: 'out' // Tipo de suavizado de la animación
            },

        };

        var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div_luz'));
        chart1.draw(data1, options1);
    }


    
</script>
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div id="chart_div_luz" style="width: 90%; height: 400px;"></div>
</div>
@endsection
