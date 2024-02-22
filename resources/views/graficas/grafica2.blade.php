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

        var indiceActual = 1; // Índice de la vista actual

        function alternarVistas() {
            // Obtener la próxima vista del arreglo
            var proximaVista = vistas[indiceActual-1];//Cambiar a +1 cuando la vista 3 esté lista
            // Redirigir a la próxima vista
            window.location.href = proximaVista;
        }

        setInterval(alternarVistas, 5000); // 10000 ms = 10 segundos
    });
</script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Datos para el sensor 2
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Hora');
            data2.addColumn('number', 'Agua');
            var measurements_id_2 = {!! json_encode($measurements_id_2) !!};

            // Eliminar el primer elemento del array measurements_id_2
            measurements_id_2.shift();

            for (var j = 0; j < measurements_id_2.length; j++) {
                data2.addRow([measurements_id_2[j].hour, measurements_id_2[j].consumo_diferencia]);
            }

            // Configuración para el gráfico del sensor 2
            var options2 = {

                curveType: 'function',
                colors: ['#dc3912'],
                backgroundColor: 'transparent',
                animation: {
                startup: true, // Activar la animación al inicio
                duration: 1000, // Duración de la animación en milisegundos (1 segundo en este caso)
                easing: 'out' // Tipo de suavizado de la animación
            },

            };

            var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div_agua'));
            chart2.draw(data2, options2);
        }

        
    </script>

@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div id="chart_div_agua" style="width: 90%; height: 400px;"></div>
    </div>
@endsection
