<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Measurement;

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

    public function grafica2()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        $measurements = Measurement::whereDate('fecha', '>=', $startOfWeek)
                                    ->whereDate('fecha', '<=', $endOfWeek)
                                    ->get();

        $title = "Consumo de la semana del $startOfWeek al $endOfWeek";
        $subtitle = "Subtítulo de la Gráfica 2";

        return view('graficas.grafica2', compact('title', 'subtitle', 'measurements'));
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
