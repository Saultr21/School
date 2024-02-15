<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;

class GraficaController extends Controller
{
    public function grafica1()
    {
        $title = "Gráfico 1";
        $subtitle = "Subtítulo de la Gráfica 1";
        $measurements = Measurement::all();
        

        return view('graficas.grafica1', compact('title', 'subtitle', 'measurements'));
    }



    public function grafica2()
    {
        $title = "Gráfica 2";
        $subtitle = "Subtítulo de la Gráfica 2";

        
        return view('graficas.grafica2', compact('title', 'subtitle'));
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
