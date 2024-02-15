<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    // La clave primaria no sigue la convención de nombres de Laravel y hay que especificar en este atributo su nombre
    protected $primaryKey = 'id_sensor';

    // Relación con Building
    public function building()
    {
        // Relación inversa de "un edificio tiene muchos sensores"
        return $this->belongsTo(Building::class, 'id_building');
    }

    // Relación con SensorType
    public function sensorType()
    {
        // Relación inversa de "un tipo de sensor tiene muchos sensores"
        return $this->belongsTo(SensorType::class, 'id_type');
    }

    // Relación con Measurement
    public function measurements()
    {
        // Un sensor tiene muchas medidas 
        return $this->hasMany(Measurement::class, 'id_sensor');
    }    
}
