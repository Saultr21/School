<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Measurement;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function grafica1()
    {
        $date = Carbon::now()->toDateString();
        $measurements = Measurement::whereDate('fecha', $date)->get();

        $title = "Consumo del día: $date";
        $subtitle = "Subtítulo de la Gráfica 1";

        return view('graficas.grafica1', compact('title', 'subtitle', 'measurements'));
    }
// Controlador
// Controlador
// Controlador
public function grafica2()
{
    // Obtener el primer día del mes anterior
    $startOfMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();

    // Obtener el último día del mes anterior
    $endOfMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();

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

    return view('graficas.grafica2', compact('title', 'subtitle', 'measurementsAgua', 'measurementsLuz'));
}



    
    public function grafica3()
    {
        $title = "Gráfica 3";
        $subtitle = "Subtítulo de la Gráfica 3";

        
        return view('graficas.grafica3', compact('title', 'subtitle'));
    }

    public function grafica4()
    {
        $title = "Gráfica 4";
        $subtitle = "Subtítulo de la Gráfica 4";

        
        return view('graficas.grafica4', compact('title', 'subtitle'));
    }

 
    
}
