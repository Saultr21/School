<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    // La clave primaria no sigue la convención de nombres de Laravel y hay que especificar en este atributo su nombre
    protected $primaryKey = 'id_measure';

    // Relación con Sensor
    public function sensor()
    {
        // Relación inversa de "un sensor tiene muchas medidas"
        return $this->belongsTo(Sensor::class, 'id_sensor');
    }    
}
