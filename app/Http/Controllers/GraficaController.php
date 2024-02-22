<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Measurement;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{

    private function convertirFecha($fecha) {
        setlocale(LC_TIME, 'es_ES.UTF-8'); // Establecer la configuración regional a español
        $fecha = Carbon::parse($fecha)->isoFormat('dddd DD [de] MMMM [de] YYYY');
    
        // Traducir el nombre del día y el mes al español
        $fecha = str_replace(
            ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            $fecha
        );
    
        $fecha = str_replace(
            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
            $fecha
        );
    
        return $fecha;
    }

public function grafica1()
{
    $dateSQL = Carbon::now()->toDateString();
    $date = $this->convertirFecha(Carbon::now());

    $measurements_id_1 = Measurement::selectRaw('DATE_FORMAT(fecha, "%H:00") as hour, 
        SUM(consumo) - COALESCE(LAG(SUM(consumo)) OVER (ORDER BY fecha), 0) as consumo_diferencia')
        ->where('id_sensor', 1)
        ->whereDate('fecha', $dateSQL)
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

    $title = "Variación de consumo de luz";
    $subtitle = $date;

    return view('graficas.grafica1', compact('title', 'subtitle', 'measurements_id_1'));
}

public function grafica2()
{
    $dateSQL = Carbon::now()->toDateString();
    $date = $this->convertirFecha(Carbon::now());

    $measurements_id_2 = Measurement::selectRaw('DATE_FORMAT(fecha, "%H:00") as hour, 
        SUM(consumo) - COALESCE(LAG(SUM(consumo)) OVER (ORDER BY fecha), 0) as consumo_diferencia')
        ->where('id_sensor', 2)
        ->whereDate('fecha', $dateSQL)
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

    $title = "Variación de consumo de agua";
    $subtitle = $date;

    return view('graficas.grafica2', compact('title', 'subtitle', 'measurements_id_2'));
}



    
    public function grafica3()
    {
    // Obtener el primer día del mes anterior
    $startOfMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();

    // Obtener el último día del mes anterior
    $endOfMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();

    // Obtener el útimo dia del mes anterior al anterior
    $endOfMonth2 = Carbon::now()->subMonths(2)->endOfMonth()->toDateString();


    $measurementAguaAnterior = Measurement::select(DB::raw('DATE(fecha) as fecha, MAX(consumo) as consumo'))
                                        ->where('id_sensor', 2)
                                        ->whereDate('fecha', '=', $endOfMonth2)
                                        ->groupBy(DB::raw('DATE(fecha)'))
                                        ->latest('fecha')
                                        ->first();

    $measurementLuzAnterior = Measurement::select(DB::raw('DATE(fecha) as fecha, MAX(consumo) as consumo'))
                                        ->where('id_sensor', 1)
                                        ->whereDate('fecha', '=', $endOfMonth2)
                                        ->groupBy(DB::raw('DATE(fecha)'))
                                        ->latest('fecha')
                                        ->first();

    $measurementsAgua = Measurement::select(DB::raw('DATE(fecha) as fecha, MAX(consumo) as consumo'))
                                ->where('id_sensor', 2) // Id del sensor de agua
                                ->whereDate('fecha', '>=', $startOfMonth)
                                ->whereDate('fecha', '<=', $endOfMonth)
                                ->groupBy(DB::raw('DATE(fecha)'))
                                ->get();

    $measurementsLuz = Measurement::select(DB::raw('DATE(fecha) as fecha, MAX(consumo) as consumo'))
                                ->where('id_sensor', 1) // Id del sensor de luz
                                ->whereDate('fecha', '>=', $startOfMonth)
                                ->whereDate('fecha', '<=', $endOfMonth)
                                ->groupBy(DB::raw('DATE(fecha)'))
                                ->get();

    $title = "Consumo del mes anterior ($startOfMonth al $endOfMonth)";
    $subtitle = "Subtítulo de la Gráfica 2";

    return view('graficas.grafica3', compact('title', 'subtitle', 'measurementsAgua', 'measurementsLuz', 'measurementAguaAnterior', 'measurementLuzAnterior', 'endOfMonth2'));
    }

    public function grafica4()
    {
        $title = "Gráfica 4";
        $subtitle = "Subtítulo de la Gráfica 4";

        
        return view('graficas.grafica4', compact('title', 'subtitle'));
    }

 
    
}
