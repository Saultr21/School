<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    
    // La clave primaria no sigue la convención de nombres de Laravel y hay que especificar en este atributo su nombre
    protected $primaryKey = 'id_building';

    // Relación con Sensor
    public function sensors()
    {
        // Un edificion tiene muchos sensores
        return $this->hasMany(Sensor::class, 'id_building');
    }    
}
